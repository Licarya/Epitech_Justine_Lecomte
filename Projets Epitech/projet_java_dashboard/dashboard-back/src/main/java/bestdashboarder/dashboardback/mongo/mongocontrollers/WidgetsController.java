package bestdashboarder.dashboardback.mongo.mongocontrollers;

import org.springframework.web.bind.annotation.RestController;

import com.mongodb.MongoException;

import org.bson.Document;
import org.bson.types.ObjectId;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;

import bestdashboarder.dashboardback.JWTService;
import bestdashboarder.dashboardback.mongo.mongomodels.Widget;
import bestdashboarder.dashboardback.mongo.mongomodels.WidgetType;
import bestdashboarder.dashboardback.mongo.mongoservices.WidgetsService;

import java.util.List;
import java.util.Map;

@RestController
public class WidgetsController {
    WidgetsService widgetsService;

    public WidgetsController() {
        this.widgetsService = new WidgetsService();
    }
    
    @PostMapping("/widgets")
    public ResponseEntity<Object> createWidget(
        @RequestBody Map<String, Object> reqBody
    ) {
        if (reqBody.get("jwt") == null)
            return new ResponseEntity<>(HttpStatus.UNAUTHORIZED);

        String userId = JWTService.getUserIdFromJWT((String)reqBody.get("jwt"));
        if (userId == null)
            return new ResponseEntity<>(
                "Invalid JWT",
                HttpStatus.UNAUTHORIZED
            );

        if (reqBody.get("widgetType") == null)
            return new ResponseEntity<>(
                "Some needed information are missing.", 
                HttpStatus.BAD_REQUEST
            );

        Widget widget = new Widget(
            new ObjectId(userId),
            WidgetType.getWidgetTypeFromString((String)reqBody.get("widgetType"))
        );

        if (reqBody.get("timer") != null)
            widget.setTimer(Double.valueOf((String)reqBody.get("timer")));
        if (reqBody.get("widgetParams") != null) {
            Map<String, String> params = (Map<String, String>)reqBody.get("widgetParams");
            params.keySet().forEach(paramName -> {
                widget.addParam(paramName, params.get(paramName));
            });
        }

        ObjectId insertedId = new WidgetsService().insert(widget);
        if (insertedId == null)
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        return new ResponseEntity<>(insertedId.toString(), HttpStatus.OK);
    }

    @GetMapping("/widgets/current")
    public ResponseEntity<Object> getCurrentUserWidgets(
        @RequestBody String reqBody
    ) {
        String userId = JWTService.getUserIdFromJWT(reqBody);
        if (userId == null)
            return new ResponseEntity<>(
                "Invalid JWT",
                HttpStatus.UNAUTHORIZED
            );
        
        try {
            List<Document> widgets = this.widgetsService.getUserWidgets(
                new ObjectId(userId)
            );
            if (widgets == null)
                return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
            return new ResponseEntity<>(
                widgets,
                HttpStatus.OK
            );
        } catch (MongoException e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
}
