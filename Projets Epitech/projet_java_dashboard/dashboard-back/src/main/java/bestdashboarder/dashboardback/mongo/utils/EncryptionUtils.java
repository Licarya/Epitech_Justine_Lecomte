package bestdashboarder.dashboardback.mongo.utils;

import com.google.common.hash.Hashing;
import java.nio.charset.StandardCharsets;
import io.github.cdimascio.dotenv.Dotenv;

public class EncryptionUtils {
    private static Dotenv dotenv = Dotenv.configure().load();

    public static String encryptSHA256(String toEncrypt) {
        return Hashing.sha256()
                .hashString(
                    toEncrypt + dotenv.get("PASSWORD_KEY"),
                    StandardCharsets.UTF_8)
                .toString();
    }

    public static String encryptSHA256(String toEncrypt, String key) {
        return Hashing.sha256()
                .hashString(
                    toEncrypt + key,
                    StandardCharsets.UTF_8)
                .toString();
    }
}
