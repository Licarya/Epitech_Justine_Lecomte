import axios from 'axios';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useForm } from '@mantine/form';
import { useCookies } from 'react-cookie';

import { TextInput, PasswordInput, Button, Center } from '@mantine/core';
import FormError from '../forms/FormError';

function LoginForm() {
  const navigate = useNavigate();
  const [cookies, setCookie] = useCookies();
  const [loginError, setLoginError] = useState(false);

  const form = useForm({
    initialValues: {
      email: '',
      password: '',
    },
  
    validate: {
      email: value => (/^\S+@\S+$/.test(value) ? null : 'Invalid email'),
      password: value => (/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{3,32}$/.test(value) ? null : 
        'Password must contain at least one digit, one uppercase letter and one lowercase letter')
    }
  });

  const onFormSumbitValidated = (values) => {
    const loginData = {
      'email': values.email,
      'password': values.password
    };

    axios.post('http://localhost:8080/login', loginData)
      .then(response => {
        setCookie('JWT', response.data);
        navigate('/');
      })
      .catch(err => {
        console.error(err);
        if (err.response.status === 404)
          setLoginError(true);
      });
  }

  return (
    <form 
      onSubmit={form.onSubmit(values => onFormSumbitValidated(values))}
      style={{width: '60%', marginLeft: '20%', marginBottom: '5%'}}>

      {
        loginError && 
        <FormError message='Wrong email or password' style={{margin: '4%'}} />
      }
      <TextInput
        withAsterisk
        required={true}
        label='Email'
        placeholder='your@email.com'
        {...form.getInputProps('email')}
        style={{marginBottom: '2.5%'}}
        onInput={() => setLoginError(false)}
      />
      <PasswordInput 
        withAsterisk
        required={true}
        label='Password'
        {...form.getInputProps('password')}
        style={{marginBottom: '2.5%'}}
        onInput={() => setLoginError(false)}
      />  
      <Center>
        <Button type="submit" color='teal'>
            Log in
        </Button>
      </Center>
    </form>
  );
}

export default LoginForm;