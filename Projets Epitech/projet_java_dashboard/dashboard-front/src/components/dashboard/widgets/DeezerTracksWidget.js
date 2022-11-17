import { useEffect, useState } from 'react';

import { Badge, Card, Center, Group, Image, TextInput } from '@mantine/core';
import { IconSettings } from '@tabler/icons';
import axios from 'axios';

function DeezerTracksWidget({timer, params}) {
  const [search, setSearch] = useState(params.search);
  const [searchResults, setSearchResults] = useState([]);
  
  useEffect(() => {
    const refreshWidgetData = () => {
      axios.get(`http://localhost:8080/deezer?search=${search}`)
      .then(response => {
        console.log(response);
        setSearchResults(response.data.titles);
        console.log(searchResults);
        console.log(searchResults[0]);
      })
      .catch(err => console.error(err));
    }

    refreshWidgetData();
    setInterval(refreshWidgetData, timer * 1000);
  }, [])

  return (
    <Card style={{width: '20vw'}} radius='md'>
      <Card.Section p="lg">
        <Group position='apart'>
          <p style={{fontWeight: 500}}>Search tracks on Deezer</p>
          <IconSettings />
        </Group>
      </Card.Section>

      <Card.Section>
        <TextInput
          withAsterisk
          required
          placeholder='Uninteded, Firestorm...'
          onChange={newValue => setSearch(newValue)}
        />
      </Card.Section>

      {searchResults.length > 0 && searchResults[0].map((track, index) => (
        <Card.Section p="lg" withBorder key={index}>
          <Center>              
            <Image
              src={track[3]}
              height={50}
              width={50}
              alt="track cover"
            />
          </Center>

          <Center><h4>{track[1]}</h4></Center>
          <Center>
              <Badge color="teal" variant="light">
                  <p>Artist : {track.artist}</p>
              </Badge>
              </Center>
              <Center>
              <Badge color="teal" variant="light">
                  <p>{track.duration} min</p>
              </Badge>
          </Center>
        </Card.Section>
      ))}
    </Card>
  )
}

export default DeezerTracksWidget;