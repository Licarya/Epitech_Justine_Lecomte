import React, {useEffect} from 'react';
import { useForm } from '@mantine/form';
import { NumberInput, TextInput, Button, CardSection } from '@mantine/core';
import { Group, Card, Image, Text, Badge, Center, Textarea } from '@mantine/core';
import axios from "axios";


const GmailSend = () => {
    const form = useForm({
        initialValues: { email: '', object: '', message: '' },

        // functions will be used to validate values at corresponding key
        validate: {
            object: (value) => (value.length < 2 ? 'Object must have at least 2 letters' : null),
            email: (value) => (/^\S+@\S+$/.test(value) ? null : 'Invalid email'),
            message: (value) => (value.length < 2 ? 'Your message must have at least 2 letters' : null),
        },
    });

    let send = function (e) {
        e.preventDefault();
        let email = form.values.email.toString();
        let object = form.values.object.toString();
        let message = form.values.message.toString();
        console.log(form.values.email + " ; " + form.values.object + " ; " + form.values.message);
        let sendMail = JSON.stringify(
            {
                fromEmailAddress: "me",
                toEmailAddress: email,
                subject: object,
                bodyText: message
            }
        );
        const customConfig = {
            headers: {
                'Content-Type': 'application/json'
            }
        };

        axios
            .post("http://localhost:8080/gmail/send", sendMail, customConfig)
            .then(res => {
                console.log("Message sent to " + email);
                form.reset();
            });
    }

    return (

        <Card.Section shadow="md" p="lg" radius="md" withBorder id='news'>
            <Center>
                <Badge color="teal" variant="light" >
                    <Text size={18}>
                        Send an email
                    </Text>
                </Badge>
            </Center>
            <form onSubmit={send}>
                <TextInput mt="sm" label="Email" placeholder="Email" {...form.getInputProps('email')} />
                <TextInput label="Object" placeholder="Object" {...form.getInputProps('object')} />
                <Textarea placeholder="Write your mail" label="Message" {...form.getInputProps('message')}></Textarea>
                <Center>
                    <Button type="submit" mt="sm" color="teal" variant="light">
                        Submit
                    </Button>
                </Center>
            </form>
        </Card.Section>
    );
};

export default GmailSend;