import axios from 'axios';
import { useEffect, useState } from 'react';
import { useCookies } from 'react-cookie';

import { Button, Card, Group, ScrollArea } from '@mantine/core';
import { IconSettings } from '@tabler/icons';

function GithubReposWidget({timer, params}) {
  const [cookies] = useCookies();

  const [reposData, setReposData] = useState([]);

  useEffect(() => {
    const refreshWidgetData = () => {
      axios.get(`http://localhost:8080/github/${params.username}?jwt=${cookies.JWT}`)
      .then(response => {
        setReposData(response.data);
      })
      .catch(err => console.error(err));
    }

    refreshWidgetData();
  }, [])

  return (
    <Card style={{width: '20vw'}} radius='md'>
      <Card.Section p='lg'>
        <Group position='apart'>
          <p style={{fontWeight: 500}}>Github user repositories</p>
          <IconSettings />
        </Group>
      </Card.Section>

      <ScrollArea style={{height: 150}} offsetScrollbars>
        {reposData.map((repoData, index) =>
          <Card.Section p='lg' withBorder key={index}>
            <Group position='apart'>
              <p style={{fontWeight: 400}}>{repoData.name}</p>
              <a href={repoData.url} rel="noreferrer noopener" target='_blank'>
                <Button variant="default">See repository</Button>
              </a>
            </Group>
          </Card.Section>
        )}
      </ScrollArea>
    </Card>
  )
}

export default GithubReposWidget;