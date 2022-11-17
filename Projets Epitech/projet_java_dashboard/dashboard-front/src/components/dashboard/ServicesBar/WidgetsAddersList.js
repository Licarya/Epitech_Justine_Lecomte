import { Button, Group } from '@mantine/core';
import { IconPlus } from '@tabler/icons';

function WidgetsAddersList({widgets, onWidgetFormUpdate, onWidgetAdded}) {
  return (
    <ul>
      {widgets.map(widget =>
        <li key={widget.type} style={{marginBottom: '0.5em'}}>
          <Button 
            variant='default' 
            style={{width: '100%'}}
            onClick={() => {
              if (widget.WidgetComponent) {
                onWidgetAdded(widget.type, 60.0, widget.WidgetComponent);
              } else {
                onWidgetFormUpdate(widget.name, widget.type, widget.WidgetFormComponent);
              }
            }}
          >
            <Group position='apart'>
              <i><IconPlus /></i>
              <p style={{fontWeight: 400}}>{widget.name}</p>
            </Group>
          </Button>
        </li>
      )}
    </ul>
  )
}

export default WidgetsAddersList;