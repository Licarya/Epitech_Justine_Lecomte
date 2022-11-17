package bestdashboarder.dashboardback;

import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.http.SessionCreationPolicy;
import org.bson.Document;
import org.bson.types.ObjectId;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.security.config.Customizer;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.web.authentication.HttpStatusEntryPoint;
import org.springframework.web.cors.CorsConfiguration;
import org.springframework.web.cors.CorsConfigurationSource;
import org.springframework.web.cors.UrlBasedCorsConfigurationSource;
import org.springframework.http.HttpStatus;

import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.springframework.security.core.Authentication;
import org.springframework.security.oauth2.client.OAuth2AuthorizedClient;
import org.springframework.security.oauth2.client.OAuth2AuthorizedClientService;
import org.springframework.security.oauth2.client.authentication.OAuth2AuthenticationToken;
import org.springframework.security.oauth2.core.user.OAuth2User;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.web.authentication.AuthenticationFailureHandler;
import org.springframework.security.web.authentication.AuthenticationSuccessHandler;

import bestdashboarder.dashboardback.mongo.mongomodels.ConnectionProvider;
import bestdashboarder.dashboardback.mongo.mongomodels.User;
import bestdashboarder.dashboardback.mongo.mongoservices.UserService;

import java.io.IOException;
import java.util.HashMap;
import java.util.List;

import javax.servlet.ServletException;

@Configuration
@EnableWebSecurity
public class SecurityConfig {
    @Autowired
    private OAuth2AuthorizedClientService clientService;

    @Bean
    public CorsConfigurationSource corsConfigurationSource() {
        final CorsConfiguration configuration = new CorsConfiguration();
        configuration.setAllowCredentials(true);
        configuration.setAllowedOrigins(List.of("http://localhost:3000"));

        configuration.setAllowedMethods(List.of("HEAD", "GET", "POST", "PUT", "DELETE", "PATCH"));
        configuration.setAllowedHeaders(List.of("Authorization", "Cache-Control", "Content-Type"));
        configuration.setExposedHeaders(List.of("Access-Control-Expose-Headers"));

        final UrlBasedCorsConfigurationSource source = new UrlBasedCorsConfigurationSource();
        source.registerCorsConfiguration("/**", configuration);
        return source;
    }

    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
        http.cors(Customizer.withDefaults());
        http.authorizeRequests(authorizeRequests ->
                authorizeRequests.anyRequest().permitAll()
            )
            .sessionManagement(config -> {
                config.sessionCreationPolicy(SessionCreationPolicy.STATELESS);
            })
            .exceptionHandling(e -> e
                .authenticationEntryPoint(new HttpStatusEntryPoint(HttpStatus.UNAUTHORIZED))
            )
            .oauth2Login()
            .successHandler(new AuthenticationSuccessHandler() {
                @Override
                public void onAuthenticationSuccess(
                    HttpServletRequest request, 
                    HttpServletResponse response,
                    Authentication authentication
                ) throws IOException, ServletException {
                    // Get needed information
                    OAuth2User userInfo = (OAuth2User)authentication
                                                        .getPrincipal();
                    OAuth2AuthenticationToken oauthToken = 
                        (OAuth2AuthenticationToken)authentication;
                    OAuth2AuthorizedClient client =
                    clientService.loadAuthorizedClient(
                            oauthToken.getAuthorizedClientRegistrationId(),
                            oauthToken.getName());
                    String accessToken = client.getAccessToken().getTokenValue();

                    String avatarUrl = userInfo.getAttribute("avatar_url");
                    String email = userInfo.getAttribute("email");
                    String name = userInfo.getAttribute("name");
                    if (name == null) {
                        String eName = email.split("@")[0];
                        name = eName.substring(0, 1).toUpperCase() + 
                               eName.substring(1);
                        name = name.replace(".", " ");
                    }

                    // Insert authenticated user if not already registered
                    User user = new User(
                        name,
                        email,
                        avatarUrl == null ?
                            (String)userInfo.getAttribute("picture") :
                            avatarUrl,
                        avatarUrl == null ?
                            ConnectionProvider.GOOGLE : 
                            ConnectionProvider.GITHUB
                    );
                    if (avatarUrl != null)
                        user.setGithubAPIKey(accessToken);

                    UserService userService = new UserService();
                    Document insertedUser = userService.getUserByEmail(
                        user.getEmail()
                    );
                    if (insertedUser != null) {
                        if (
                            avatarUrl != null && 
                            insertedUser.get("github_api_key") == null
                        ) {
                            HashMap<String, Object> updates = new HashMap<>();
                            updates.put("github_api_key", user.getGithubAPIKey());
                            List<String> updatedServices = insertedUser.getList(
                                "services",
                                 String.class
                            );
                            updatedServices.add("GITHUB");
                            updates.put("services", updatedServices);
                            userService.updateById(
                                insertedUser.getObjectId("_id"),
                                updates
                            );
                        } else if (
                            avatarUrl == null &&
                            insertedUser.get("google_api_key") == null
                        ) {
                            HashMap<String, Object> updates = new HashMap<>();
                            List<String> updatedServices = insertedUser.getList(
                                "services",
                                 String.class
                            );
                            updatedServices.add("GOOGLE");
                            updates.put("services", updatedServices);
                            userService.updateById(
                                insertedUser.getObjectId("_id"),
                                updates
                            );
                        }

                        Cookie jwt = new Cookie(
                            "JWT", 
                            JWTService.generateJWT(
                                insertedUser.getObjectId("_id").toString()
                            )
                        );
                        jwt.setHttpOnly(false);
                        jwt.setPath("/");
                        response.addCookie(jwt);
                    } else {
                        ObjectId userId = userService.insertIfNotPresent(user);
                        Cookie jwt = new Cookie(
                            "JWT", 
                            JWTService.generateJWT(userId.toString())
                        );
                        jwt.setHttpOnly(false);
                        jwt.setPath("/");
                        response.addCookie(jwt);
                    }

                    response.sendRedirect("http://localhost:3000/");
                }
            });
        http.csrf().disable();
        return http.build();
    }
}
