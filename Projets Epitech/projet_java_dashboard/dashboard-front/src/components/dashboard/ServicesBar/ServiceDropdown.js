import { Accordion, Button } from '@mantine/core';
import WidgetsAddersList from './WidgetsAddersList';

function ServiceDropdown({
  serviceName, 
  widgets, 
  authorizationLink,
  onWidgetFormUpdate,
  onWidgetAdded
}) {
  return (
    <Accordion.Item value={serviceName}>
      <Accordion.Control>{serviceName}</Accordion.Control>
      <Accordion.Panel>
        {
          authorizationLink ? 
            <a href={authorizationLink}>
              <Button variant='default' style={{width: '100%'}}>
                Authorize {serviceName}
              </Button>
            </a> : 
            <WidgetsAddersList 
              widgets={widgets} 
              onWidgetFormUpdate={onWidgetFormUpdate}
              onWidgetAdded={onWidgetAdded}
            />
        }
      </Accordion.Panel>
    </Accordion.Item>
  )
}

export default ServiceDropdown;