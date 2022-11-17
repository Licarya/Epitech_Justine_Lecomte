package bestdashboarder.dashboardback.mongo.mongoservices;

import java.util.List;
import java.util.ArrayList;
import java.util.Map;

import org.bson.Document;
import org.bson.conversions.Bson;
import org.bson.types.ObjectId;

import com.mongodb.MongoBulkWriteException;
import com.mongodb.MongoException;
import com.mongodb.MongoQueryException;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.model.Filters;
import com.mongodb.client.result.DeleteResult;
import com.mongodb.client.result.InsertOneResult;
import com.mongodb.client.result.UpdateResult;

import bestdashboarder.dashboardback.mongo.mongomodels.Widget;

public class WidgetsService {
    private MongoCollection<Document> widgetsCollection;

    public WidgetsService() {
        this.widgetsCollection = DBManager.getDatabase().getCollection(
            "widgets"
        );
    }

    /**
     * Get all the widgets for a given user.
     * @param userId The id of the user.
     * @return all the widgets if successful (can be empty), null otherwise.
     */
    public List<Document> getUserWidgets(ObjectId userId) {
        ArrayList<Document> userWidgets = new ArrayList<>();
        Bson filter = Filters.all("userId", userId);

        try {
            this.widgetsCollection.find(filter).forEach(widget -> {
                userWidgets.add(widget);
            });
            return userWidgets;
        } catch (MongoQueryException e) {
            System.err.println(
                "An error occured while trying to find a user: " +
                e.getMessage()
            );
            return null;
        }
    }

    /**
     * Try to insert the given widget inside the database.
     * @param widget the configured widget to insert.
     * @return the inserted id if the operation was successful, null otherwise.
     */
    public ObjectId insert(Widget widget) {
        Document doc = new Document()
                        .append("user_id", widget.getUserId())
                        .append("type", widget.getWidgetType())
                        .append("timer", widget.getTimer())
                        .append("params", widget.getParams());
        try {
            InsertOneResult res = this.widgetsCollection.insertOne(doc);
            if (res.wasAcknowledged())
                return res.getInsertedId().asObjectId().getValue();
            else
                return null;
        } catch (MongoBulkWriteException e) {
            System.err.println(
                "An error occured trying to insert a new widget: " +
                e.getMessage()
            );
            return null;
        }
    }

    /**
     * Try to update the widget with the given id with the given updates.
     * @param widgetId the id of the widget to update.
     * @param updates the updates to apply.
     * @return true if the update was successful, false otherwise
     */
    public boolean updateById(ObjectId widgetId, Map<String, String> updates) {
        Bson filter = Filters.all("_id", widgetId);
        Document doc = new Document();
        if (updates.containsKey("name"))
            doc = doc.append("name", updates.get("name"));
        if (updates.containsKey("timer"))
            doc = doc.append("timer", Double.parseDouble(updates.get("timer")));
        if (updates.containsKey("params"))
            doc = doc.append("params", updates.get("params"));

        try {
            UpdateResult res = this.widgetsCollection.updateOne(filter, doc);
            return res.wasAcknowledged();
        } catch (MongoException e) {
            System.err.println(
                "An error occured trying to update a widget: " +
                e.getMessage()
            );
            return false;
        }
    }

    /**
     * Try to delete the widget with the given widget id.
     * @param widgetId the id of the widget to delete.
     * @return true if the deletion was successful, false otherwise.
     */
    public boolean deleteById(ObjectId widgetId) {
        Bson filter = Filters.all("_id", widgetId);

        try {
            DeleteResult res = this.widgetsCollection.deleteOne(filter);
            return res.wasAcknowledged();
        } catch (MongoException e) {
            System.err.println(
                "An error occured trying to delete a widget: " +
                e.getMessage()
            );
            return false;
        }
    }
}
