import React, { useEffect } from 'react';
import { useState } from 'react';
import { Group, Card, Image, Text, Badge, Center } from '@mantine/core';
import axios from 'axios';

const Gmail = () => {
    const [data, setData] = useState([]);

    useEffect(() => {
        axios
            .get("http://localhost:8080/gmail")
            .then((res) => setData(res.data));
    }, []);
    return (
        <div>

            {data.length > 0 &&
                <Card.Section shadow="md" p="lg" radius="md" withBorder id='news'>
                    {data.map((key, index) =>
                    (<Card shadow="md" p="lg" radius="md" withBorder className='news' key={index}>
                        <Badge color="teal" variant="light" >
                            <Text size={12} key={index}>{key.fromEmail}</Text>
                        </Badge><br />
                            <Text size={12} key={index}>Object : {key.subject}</Text><br />
                            <Text size={12} key={index}>{key.snippet}....</Text><br />
                    </Card>
                    ))}
                </Card.Section>
            }

        </div>
    );
};

export default Gmail;