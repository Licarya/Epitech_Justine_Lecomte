package bestdashboarder.dashboardback.google;

import com.google.api.client.googleapis.javanet.GoogleNetHttpTransport;
import com.google.api.client.http.javanet.NetHttpTransport;
import com.google.api.services.gmail.Gmail;
import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpHead;
import org.apache.http.conn.ssl.NoopHostnameVerifier;
import org.apache.http.conn.ssl.TrustAllStrategy;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.ssl.SSLContextBuilder;

public class GoogleConnection {
    public static Gmail connection(Gmail gmail){
        try {
            final NetHttpTransport HTTP_TRANSPORT = GoogleNetHttpTransport.newTrustedTransport();
            if(gmail == null) {
                Runtime rt = Runtime.getRuntime();
                String url = "https://accounts.google.com/o/oauth2/auth?" +
                        "access_type=offline&" +
                        "client_id=739334963786-b9hiehbhbfaee724ji5o2ra0t0s68ib5.apps.googleusercontent.com&" +
                        "redirect_uri=http://localhost:8888/Callback&" +
                        "response_type=code&" +
                        "scope=https://mail.google.com/";
                if(isReachable("http://localhost:8888/Callback")) {
                    rt.exec("rundll32 url.dll, FileProtocolHandler " + url);
                }

                gmail = new Gmail.Builder(
                        HTTP_TRANSPORT,
                        GoogleInit.getJsonFactory(),
                        GoogleInit.getCredentials(HTTP_TRANSPORT))
                        .setApplicationName(GoogleInit.getApplicationName())
                        .build();
            }
            return gmail;
        }
        catch (Exception e){
            System.out.println();
            System.out.println(e.getMessage());
            System.out.println();
            return gmail;
        }
    }

    public static boolean isReachable(String url) {
        boolean isReachable = true;
        try (CloseableHttpClient httpClient = HttpClients.custom()
                .setSSLContext(new SSLContextBuilder().loadTrustMaterial(null, TrustAllStrategy.INSTANCE).build())
                .setSSLHostnameVerifier(NoopHostnameVerifier.INSTANCE)
                .build())
        {
            HttpHead request = new HttpHead(url);
            CloseableHttpResponse response = httpClient.execute(request);

            if (response.getStatusLine().getStatusCode() == 404) {
                System.out.println("URL " + url + " Not found");
                isReachable = false;
            }
        } catch (Exception e) {
            isReachable = false;
        }
        return isReachable;
    }
}