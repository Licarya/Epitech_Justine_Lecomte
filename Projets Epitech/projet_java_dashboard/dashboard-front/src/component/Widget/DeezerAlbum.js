import React, { useEffect } from 'react';

import { useState } from 'react';
import { useForm } from '@mantine/form';
import { TextInput, Button, Box, Group, Card, Image, Text, Badge, Center } from '@mantine/core';
import axios from 'axios';


const DeezerAlbum = () => {
    const [submittedValues, setSubmittedValues] = useState('');
    const [data, setData] = useState([]);

    const form = useForm({

        transformValues: (values) => ({
            yourSearch: `${values.search}`,
        }),
    });

    useEffect(() => {
        axios
            .get("http://localhost:8080/deezerAlbum?search=orelsan")
            .then((res) => setData(res.data));
    }, []);
    return (
        <div>

            {data.length > 0 &&
                <Card.Section shadow="md" p="lg" radius="md" withBorder id='titre'>


                    {data[1].map((key, index) =>
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
                                <Text size={12} key={index}>Track : {key.tracks}</Text>
                            </Badge>
                        </Center>
                    </Card>
                    ))}
                </Card.Section>
            }

        </div>
    );
};

export default DeezerAlbum;