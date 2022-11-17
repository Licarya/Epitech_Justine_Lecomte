import React, { useEffect } from 'react';


import { useState } from 'react';
import { useForm } from '@mantine/form';
import { TextInput, Button, Box, Group, Card, Image, Text, Badge, Center } from '@mantine/core';
import axios from 'axios';


const DeezerSearch = () => {
  const [submittedValues, setSubmittedValues] = useState('');
  const [data, setData] = useState([]);

  const form = useForm({

    transformValues: (values) => ({
      yourSearch: `${values.search}`,
    }),
  });

  useEffect(() => {
    axios
      .get("http://localhost:8080/deezer?search=hippo")
      .then((res) => setData(res.data));
  }, []);
  return (
    <div>
      {/* <Box sx={{ maxWidth: 200 }} mx="auto">
          <form
            onSubmit={form.onSubmit((values) => setSubmittedValues(JSON.stringify(values, null, 2)))}
            >
            <Group>
            <TextInput
              label="Your Search"
              placeholder="Search"
              {...form.getInputProps('search')}
            />

            <Button type="submit">
              Submit
            </Button>
          </Group>
          </form>
    
          {submittedValues && <Code block>{submittedValues}</Code>}
        </Box> */}

      {data.length > 0 &&
        <Card.Section shadow="md" p="lg" radius="md" withBorder id='titre'>


          {data[0].map((key, index) =>
          (<Card shadow="md" p="lg" radius="md" withBorder className='title' key={index}>
            <Center>              
              <Image
                key={index}
                src={key.cover}
                height={50}
                width={50}
                alt="temps actuel"
              />
              </Center>

               <Center>
                            <Group position="apart">
                                <Badge color="teal" variant="light">
                                    <Text size={13} key={index}>{key.title}</Text>
                                </Badge>
                            </Group>
                        </Center>
                        <Center>
                            <Badge color="teal" variant="light">
                                <Text size={12} key={index}>Artist : {key.artist}</Text>
                            </Badge>
                            </Center>
                            <Center>
                            <Badge color="teal" variant="light">
                                <Text size={12} key={index}>{key.duration} min</Text>
                            </Badge>
                        </Center>

          </Card>

          ))}
        </Card.Section>
      }

    </div>
  );
};

export default DeezerSearch;