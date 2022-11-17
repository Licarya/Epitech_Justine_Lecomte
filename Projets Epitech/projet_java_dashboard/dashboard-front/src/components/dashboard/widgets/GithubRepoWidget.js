import axios from 'axios';
import { useEffect, useState } from 'react';
import { useCookies } from 'react-cookie';

import { Card, Group } from '@mantine/core';
import { IconSettings, IconStar, IconEye } from '@tabler/icons';

function GithubRepoWidget({timer, params}) {
  const [cookies] = useCookies();

  const [repoData, setRepoData] = useState({});

  useEffect(() => {
    const refreshWidgetData = () => {
      axios.get('http://localhost:8080/github/' + 
        `${params.username}/${params.repository}?jwt=${cookies.JWT}`
      )
      .then(response => {
        console.log(response);
        setRepoData(response.data);
      })
      .catch(err => console.error(err));
    }

    refreshWidgetData();
  }, [])

    return (
      <Card style={{width: '20vw'}} radius='md'>
        <Card.Section p='lg' style={{borderBottom: '1px solid lightgray'}}>
          <Group position='apart'>
            <p style={{fontWeight: 500}}>Github repository</p>
            <IconSettings />
          </Group>
        </Card.Section>
        <Card.Section p='lg'>
          <Group position='apart'>
            <a 
              href={repoData.url}
              target='_blank' 
              rel='' 
              style={{fontWeight: 400, fontSize: '1.25em'}}
            >
              {repoData.name}
            </a>
            <Group>
              <Group>
                <IconStar />
                <p>{repoData.stars_count}</p>
              </Group>
              <Group>
                <IconEye />
                <p>{repoData.watchers_count}</p>
              </Group>
            </Group>
          </Group>
          <p style={{marginTop: '0.25em', marginBottom: '1em'}}>
            {repoData.description}
          </p>
          <Group position='apart'>
            <p>{new Date(repoData.creation_date).toDateString()}</p>
            <p>{repoData.visibility}</p>
          </Group>
        </Card.Section>
      </Card>
    )
  }
  
  export default GithubRepoWidget;