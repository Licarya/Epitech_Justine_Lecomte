package bestdashboarder.dashboardback.google;

import com.google.api.client.googleapis.javanet.GoogleNetHttpTransport;
import com.google.api.client.googleapis.json.GoogleJsonError;
import com.google.api.client.googleapis.json.GoogleJsonResponseException;
import com.google.api.client.http.javanet.NetHttpTransport;
import com.google.api.services.gmail.Gmail;
import com.google.api.services.gmail.model.Message;
import com.google.api.services.gmail.model.MessagePartHeader;
import io.swagger.annotations.ApiOperation;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import javax.mail.MessagingException;
import javax.mail.internet.MimeMessage;
import java.io.IOException;
import java.security.GeneralSecurityException;
import java.util.ArrayList;
import java.util.List;

import static bestdashboarder.dashboardback.google.DataFromMail.createEmail;
import static bestdashboarder.dashboardback.google.DataFromMail.createMessageWithEmail;

@RestController
public class GoogleController {
    private Gmail gmail = null;

    @GetMapping("/gmail/connect")
    public ResponseEntity<Object> gmailConnect() {
        gmail = GoogleConnection.connection(gmail);
        return new ResponseEntity<>(HttpStatus.OK);
    }
    
    @ApiOperation(
        value = "Get all mails inbox of current user", 
        notes = "Return all mails received by the current user"
    )
    @GetMapping("/gmail")
    public List<GmailModel> getAllMails() throws GeneralSecurityException, IOException {
        List<Message> messages = gmail.users().messages()
            .list("me")
            .setMaxResults(11L)
            .execute()
            .getMessages();
        List<GmailModel> mails = new ArrayList<>();
        String fromName = "";
        String fromEmail = "";
        String subject = "";
        String snippet = "";

        for(int i = 0; i < messages.size(); i++){
            List<MessagePartHeader> headers =
                    gmail.users().messages().get("me", messages.get(i).getId())
                    .execute().getPayload().getHeaders();
            for(MessagePartHeader header : headers){
                if(header.getName().equals("From")){
                    boolean separatorNameEmail = false;
                    for(char c : header.getValue().toCharArray()){
                        if(!String.valueOf(c).equals("<") && !separatorNameEmail)
                        fromName += c;
                        else {
                            separatorNameEmail = true;
                            fromEmail += c;
                        }
                    }
                    fromName = fromName.substring(0, fromName.length() - 1);
                    fromEmail = fromEmail.replace("<", "");
                    fromEmail = fromEmail.replace(">", "");
                }
                if(header.getName().equals("Subject")){
                    subject = header.getValue();
                }
            }
            snippet = gmail.users().messages().get("me", messages.get(i).getId()).execute().getSnippet();
            if(!fromEmail.equals("")) {
                GmailModel gmailModel = new GmailModel(
                        fromName,
                        fromEmail,
                        subject,
                        snippet);
                mails.add(gmailModel);
            }
            fromName = "";
            fromEmail = "";
            subject = "";
            snippet = "";
        }
        return mails;
    }
    @ApiOperation(value = "Send a mail with request body")
    @PostMapping(value = "/gmail/send")
    public Message sendEmail(@RequestBody MailModel mailModel)
            throws MessagingException, IOException, GeneralSecurityException {
        // Create the email content
        MimeMessage email = createEmail(gmail.users().getProfile("me").getUserId(), mailModel.getToEmailAddress(), mailModel.getSubject(), mailModel.getBodyText());
        // Encode and wrap the MIME message into a gmail message
        Message message = createMessageWithEmail(email);

        try {
            // Create send message
            message = gmail.users().messages().send("me", message).execute();
            System.out.println("Message id: " + message.getId());
            System.out.println(message.toPrettyString());
            return message;
        } catch (GoogleJsonResponseException e) {
            GoogleJsonError error = e.getDetails();
            if (error.getCode() == 403) {
                System.err.println("Unable to send message: " + e.getDetails());
            } else {
                throw e;
            }
        }
        return null;
    }
}