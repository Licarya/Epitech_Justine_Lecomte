import { useEffect, useState } from 'react';

import { Card, Group, Center, Text, Badge, Image } from '@mantine/core';
import { IconSettings } from '@tabler/icons';
import axios from 'axios';

function WeatherDayWidget({timer, params}) {
  const [weatherData, setWeatherData] = useState({});
  
  useEffect(() => {
    const refreshWidgetData = () => {
      axios.get(`http://localhost:8080/weather?city=${params.city}`)
      .then(response => {
        console.log(response);
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
          <p style={{fontWeight: 500}}>Weather</p>
          <IconSettings />
        </Group>
      </Card.Section>

      <Card.Section p="lg">
        <Center>
          <Group position="apart">
            <Text weight={500} size={20}>{params.city}</Text>
            <Badge color="teal" variant="light">
              <Text size={20}>{weatherData.temperature}°C</Text>
            </Badge>
          </Group>
        </Center>
      </Card.Section>

      <Card.Section>
        <Center>
          <Image
            src={weatherData.picture}
            height={100}
            width={100}
            alt="temps actuel"
          />
        </Center>
        <Center>
          <Group position="apart" mt="md" mb="xs">
            <Image
              src="https://img.icons8.com/color/96/null/windsock--v1.png"
              height={50}
              width={50}
              alt="temps actuel"
            />
            <Badge color="teal" variant="light">
              <Text size={15}>{weatherData.windspeed} km/h</Text>
            </Badge>
          </Group>
        </Center>
      </Card.Section>
    </Card>
  )
}

export default WeatherDayWidget;