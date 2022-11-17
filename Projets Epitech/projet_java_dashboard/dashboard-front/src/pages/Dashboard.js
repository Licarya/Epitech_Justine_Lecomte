import axios from 'axios';
import { useState, useEffect, cloneElement } from 'react';
import { useNavigate } from 'react-router-dom';
import { useCookies } from 'react-cookie';
import servicesConfig from '../servicesConfig';

import ServicesBar from "../components/dashboard/servicesBar/ServicesBar";
import WidgetFormContainer from '../components/dashboard/widgetsForms/WidgetFormContainer';

function Dashboard() {
  const navigate = useNavigate();
  const [cookies] = useCookies();

  const [userInfo, setUserInfo] = useState({});
  const [services, setServices] = useState(servicesConfig);

  const [widgetFormConfig, setWidgetFormConfig] = useState({
    name: '',
    opened: false,
    WidgetFormComponent: undefined
  });
  const [widgets, setWidgets] = useState([]);

  useEffect(() => {
    if (!cookies.JWT) 
      navigate('/login');

    axios.get(
      'http://localhost:8080/users/current',
      {
        params: {
          jwt: cookies.JWT
        }
      }
    )
      .then(response => {
        setUserInfo({
          name: response.data.name,
          avatarUrl: response.data.avatarUrl,
          email: response.data.email
        });
        
        let allowedServices = [].concat(services);
        if (!response.data.services.find(service => service === 'GITHUB')) {
          allowedServices[3]['authorizationLink'] = 
            'http://localhost:8080/oauth2/authorization/github';
        }
        if (!response.data.services.find(service => service === 'GOOGLE')) {
          allowedServices[4]['authorizationLink'] = 
            'http://localhost:8080/oauth2/authorization/google';
        }

        setServices(allowedServices);
      })
      .catch(err => {
        console.log(err);
        if (err.response.status === 401 || err.response.status === 404)
          navigate('/login');
      });
  }, [])

  const onWidgetFormUpdate = (name, widgetType, WidgetFormComponent, defaultParams) => {
    setWidgetFormConfig({
      name,
      opened: true,
      WidgetFormComponent: cloneElement(
        WidgetFormComponent,
        {
          widgetType,
          defaultParams: defaultParams, 
          onWidgetAdded: onWidgetAdded
        }
      ),
    });
  }

  const onWidgetAdded = (
    widgetType,
    timer,
    WidgetComponent,
    widgetParams
  ) => {
    // Save widget into database
    axios.post('http://localhost:8080/widgets', {
      jwt: cookies.JWT,
      widgetType,
      timer: parseFloat(timer).toFixed(2),
      widgetParams
    })
      .then(response => console.log(response))
      .catch(err => console.error(err));

    // Add new widget to view
    widgets.push(cloneElement(
      WidgetComponent,
      {
        params: widgetParams,
        timer: timer,
        onWidgetUpdated: undefined
      }
    ));
    setWidgets([].concat(widgets));
    setWidgetFormConfig({
      ...widgetFormConfig,
      opened: false
    });
  }

  return (
    <>
      <WidgetFormContainer 
          opened={widgetFormConfig.opened}
          widgetName={widgetFormConfig.name}
          closeModal={() => setWidgetFormConfig({
            ...widgetFormConfig,
            opened: false
          })}
        >
          {widgetFormConfig.WidgetFormComponent}
        </WidgetFormContainer>
      <div style={{display: 'flex', flexFlow: 'row nowrap'}}>
        <ServicesBar 
          services={services} 
          userInfo={userInfo} 
          onWidgetFormUpdate={onWidgetFormUpdate}
          onWidgetAdded={onWidgetAdded}
        />
        <div>
          {widgets.map(Widget =>
              Widget
          )}
        </div>
      </div>
    </>
  );
}

export default Dashboard;