package bestdashboarder.dashboardback.mongo.mongomodels;

import java.util.Map;
import java.util.HashMap;

import org.bson.types.ObjectId;

public class Widget {
    private ObjectId userId;
    private WidgetType widgetType;
    private Double timer;
    private Map<String, String> params;

    public Widget(
        final ObjectId userId, 
        final WidgetType widgetType
    ) {
        this.userId = userId;
        this.widgetType = widgetType;
        this.timer = Double.valueOf(60);
        this.params = new HashMap<>();
    }

    public Widget (
        final ObjectId userId, 
        final WidgetType widgetType,
        final Double timer
    ) throws ModelException {
        if (timer < 0)
            throw new ModelException("widgets", "timer");

        this.userId = userId;
        this.widgetType = widgetType;
        this.timer = timer;
        this.params = new HashMap<>();
    }

    public Widget (
        final ObjectId userId, 
        final WidgetType widgetType,
        final Map<String, String> params
    ) throws ModelException {
        this.userId = userId;
        this.widgetType = widgetType;
        this.timer = Double.valueOf(60);
        this.params = params;
    }

    public Widget (
        final ObjectId userId, 
        final WidgetType widgetType,
        final Double timer,
        final Map<String, String> params
    ) throws ModelException {
        if (timer < 0)
            throw new ModelException("widgets", "timer");

        this.userId = userId;
        this.widgetType = widgetType;
        this.timer = timer;
        this.params = params;
    }

    /**
     * @return ObjectId return the userId
     */
    public ObjectId getUserId() {
        return userId;
    }

    /**
     * @param userId the userId to set
     */
    public void setUserId(ObjectId userId) {
        this.userId = userId;
    }

    /**
     * @return WidgetType return the widgetType
     */
    public WidgetType getWidgetType() {
        return widgetType;
    }

    /**
     * @param widgetType the widgetType to set
     */
    public void setWidgetType(WidgetType widgetType) {
        this.widgetType = widgetType;
    }

    /**
     * @return double return the timer
     */
    public Double getTimer() {
        return timer;
    }

    /**
     * @param timer the timer to set
     */
    public void setTimer(Double timer) {
        this.timer = timer;
    }

    /**
     * @return Map<String, String> return the params
     */
    public Map<String, String> getParams() {
        return params;
    }

    /**
     * Add a new parameter to the widget.
     * @param name the param name to add.
     * @param value the param value to add.
     */
    public void addParam(String name, String value) {
        this.params.put(name, value);
    }

    /**
     * Remove a parameter from the widget.
     * @param name the param name to remove.
     */
    public void removeParam(String name) {
        this.params.remove(name);
    }
}
