import axios from 'axios';
import { useEffect, useState } from 'react';

import { Badge, Card, Center, Group, Image, ScrollArea, Text } from '@mantine/core';
import { IconSettings } from '@tabler/icons';

function WeatherHoursWidget({timer, params}) {
  const [weatherData, setWeatherData] = useState([]);
  
  useEffect(() => {
    const refreshWidgetData = () => {
      axios.get(`http://localhost:8080/weatherHourly?city=${params.city}`)
      .then(response => {
        setWeatherData(response.data);
      })
      .catch(err => console.error(err));
    }
    
    refreshWidgetData();
    setInterval(refreshWidgetData, timer * 1000);
  }, [])

  return (
    <Card style={{width: '15vw'}} radius='md'>
      <Card.Section p="lg">
        <Group position='apart'>
          <p style={{fontWeight: 500}}>Weather per hour</p>
          <IconSettings />
        </Group>
      </Card.Section>

      {
        weatherData.length > 0 &&
          <Card.Section p="lg">
            <Center>
              <Text weight={500} size={20} className="ville">
                {params.city}
              </Text>
            </Center>
          </Card.Section>
      }

      <ScrollArea style={{ height: 170 }} offsetScrollbars>
        {weatherData.map((key, index) => (
          <Card.Section p="lg" withBorder key={index}>
            <Center>
              <Text>{index}h</Text>
            </Center>

            <Center>
              <Group position="apart">
                <Image
                  src={key.picture}
                  height={35}
                  width={35}
                  alt="actual weather"
                />
                <Badge color="teal" variant="light">
                  <Text size={15} key={index}>{key.temperature}°C</Text>
                </Badge>
              </Group>
            </Center>

            <Center>
              <Group position='apart'>
                <Image
                  src="https://img.icons8.com/external-justicon-flat-justicon/64/null/external-humidity-weather-justicon-flat-justicon-1.png"
                  height={35}
                  width={35}
                  alt="temps actuel"
                />
                <Badge color="teal" variant="light">
                  <Text size={15} key={index}>{key.humidity} %</Text>
                </Badge>
              </Group>
            </Center>

            <Center>
              <Group position="apart">
                <Image
                  src="https://img.icons8.com/color/96/null/windsock--v1.png"
                  height={35}
                  width={35}
                  alt="temps actuel"
                />
                <Badge color="teal" variant="light">
                  <Text size={12} key={index}>{key.windspeed} km/h</Text>
                </Badge>
              </Group>
            </Center>
          </Card.Section>
        ))}
      </ScrollArea>
    </Card>
  )
}

export default WeatherHoursWidget;