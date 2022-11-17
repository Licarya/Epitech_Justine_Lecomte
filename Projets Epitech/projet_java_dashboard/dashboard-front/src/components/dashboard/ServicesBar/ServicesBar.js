import { Navbar, Accordion } from '@mantine/core';
import Logo from './Logo';
import UserMenu from './UserMenu';
import ServiceDropdown from './ServiceDropdown';

import '../../../assets/styles/components/dashboard/serviceBar/userMenu.css';

function ServicesBar({
  services, 
  userInfo, 
  onWidgetFormUpdate,
  onWidgetAdded
}) {
  return (
    <Navbar p='sm' width={{ base: 340 }} style={{
      boxShadow: '1px 0px 10px rgba(0, 0, 0, 0.2)'
    }}>
      <Navbar.Section style={{marginTop: '0.5em', marginBottom: '1.5em'}}>
        <Logo />
      </Navbar.Section>

      <Navbar.Section grow style={{
        paddingTop: '1em',
        borderTop: '1px solid lightgray',
        borderBottom: '1px solid lightgray'
      }}>
        <h3 style={{margin: '4%', marginTop: 0}}>Services</h3>
        <Accordion variant='separated'>
          {services.map(service => 
            <ServiceDropdown 
              key={service.name}
              serviceName={service.name} 
              widgets={service.widgets} 
              authorizationLink={service.authorizationLink}
              onWidgetFormUpdate={onWidgetFormUpdate}
              onWidgetAdded={onWidgetAdded}
            />
          )}
        </Accordion>
      </Navbar.Section>

      <Navbar.Section 
        className='user-menu-container'
        style={{marginTop: '0.5em', padding: '1em', borderRadius: '5px'}}
      >
        <UserMenu userInfo={userInfo} />
      </Navbar.Section>
    </Navbar>
  )
}

export default ServicesBar;