import axios from 'axios';
import { useEffect, useState } from 'react';

import { Badge, Card, Group, Image, ScrollArea } from '@mantine/core';
import { IconSettings } from '@tabler/icons';

function SciencesWidget() {
  const [newsData, setNewsData] = useState([]);

  useEffect(() => {
    const refreshWidgetData = () => {
      axios.get('http://localhost:8080/news/sciences')
      .then(response => {
        setNewsData(response.data);
      })
      .catch(err => console.error(err));
    }

    refreshWidgetData();
  }, [])

  return (
    <Card style={{width: '35vw'}} radius='md'>

      {newsData.length > 0 &&
        <Card.Section p='lg' style={{borderBottom: '1px solid lightgray'}}>
          <Group position='apart'>
            <Group>
              <Image
                  src="https://upload.wikimedia.org/wikipedia/fr/archive/8/89/20200619132506%21Science_et_Avenir.svg"
                  height={50}
                  alt="science et avenir logo"
              />
            </Group>
            <IconSettings />
          </Group>
        </Card.Section>
      }

      <ScrollArea style={{height: 450}} offsetScrollbars>
        {newsData.map((news, index) =>
          <Card.Section p='lg' withBorder key={index}>
            <div style={{marginBottom: '1em'}}>
              <h4>{news.title}</h4>
              <i>{new Date(news.date).toDateString()}</i>
            </div>
            <p style={{marginBottom: '1em'}}>{news.description}</p>
            <a href={news.link} rel="noreferrer noopener" target='_blank'>
              En savoir plus
            </a>
          </Card.Section>
        )}
      </ScrollArea>
    </Card>
  );
}

export default SciencesWidget;