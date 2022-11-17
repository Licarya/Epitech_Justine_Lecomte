package bestdashboarder.dashboardback;

import io.jsonwebtoken.JwtException;
import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;
import javax.crypto.spec.SecretKeySpec;
import java.security.Key;
import java.time.Instant;
import java.util.Base64;
import java.util.Date;
import java.util.UUID;

public class JWTService {
    private JWTService() {}

    public static String generateJWT(String userId) {
        String secret = "asdfSFS34wfsdfsdfSDSD32dfsddDDerQSNCK34SOWEK5354fdgdf4";

        Key hmacKey = new SecretKeySpec(Base64.getDecoder().decode(secret), 
                            SignatureAlgorithm.HS256.getJcaName());

        return Jwts.builder()
                .claim("userId", userId)
                .setSubject("user")
                .setId(UUID.randomUUID().toString())
                .setIssuedAt(Date.from(Instant.now()))
                .signWith(SignatureAlgorithm.HS256, hmacKey)
                .compact();
    }

    public static String getUserIdFromJWT(String jwtString) {
        String secret = "asdfSFS34wfsdfsdfSDSD32dfsddDDerQSNCK34SOWEK5354fdgdf4";
        Key hmacKey = new SecretKeySpec(Base64.getDecoder().decode(secret), 
                                        SignatureAlgorithm.HS256.getJcaName());
    
        try {
            return Jwts.parser()
                    .setSigningKey(hmacKey)
                    .parseClaimsJws(jwtString)
                    .getBody().get("userId").toString();
        } catch (JwtException e) {
            System.err.println(e.getMessage());
            return null;
        }
    }
}
