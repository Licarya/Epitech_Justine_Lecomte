import axios from 'axios';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useForm } from '@mantine/form';
import { useCookies } from 'react-cookie';

import { TextInput, PasswordInput, Button, Center } from '@mantine/core';
import FormError from '../forms/FormError';

function RegisterForm() {
  const navigate = useNavigate();
  const [cookies, setCookie] = useCookies();
  const [registerError, setRegisterError] = useState(false);

  const form = useForm({
    initialValues: {
      name: '',
      email: '',
      password: '',
      confirmPassword: ''
    },
  
    validate: {
      name: value => (/^[a-zA-Z][0-9a-zA-Z .,'-]*$/.test(value) ? null :
        'Invalid name'),
      email: value => (/^\S+@\S+$/.test(value) ? null : 'Invalid email'),
      password: value => (/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{3,32}$/.test(value) ? null : 
        'Password must contain at least one digit, one uppercase letter and one lowercase letter'),
    }
  });

  const onFormSumbitValidated = (values) => {
    if (values.confirmPassword !== values.password) {
      form.setFieldError('confirmPassword', 'The two passwords does not match');
      return;
    }

    const registerData = {
      'name': values.name,
      'email': values.email,
      'password': values.password
    };

    axios.post('http://localhost:8080/users', registerData)
      .then(response => {
        setCookie('JWT', response.data);
        navigate('/');
      })
      .catch(err => {
        console.error(err);
        if (err.response.status === 409)
          setRegisterError(true);
      });
  }

  return (
    <form 
      onSubmit={form.onSubmit(values => onFormSumbitValidated(values))}
      style={{width: '80%', marginLeft: '10%'}}>

      {registerError && <FormError message='This account already exists' />}
      <TextInput
        withAsterisk
        required={true}
        label='Name'
        placeholder='Your Name'
        {...form.getInputProps('name')}
        style={{marginBottom: '2.5%'}}
        onInput={() => setRegisterError(false)}
      />
      <TextInput
        withAsterisk
        required={true}
        label='Email'
        placeholder='your@email.com'
        {...form.getInputProps('email')}
        style={{marginBottom: '2.5%'}}
        onInput={() => setRegisterError(false)}
      />
      <PasswordInput 
        withAsterisk
        required={true}
        label='Password'
        {...form.getInputProps('password')}
        style={{marginBottom: '2.5%'}}
        onInput={() => setRegisterError(false)}
      />
      <PasswordInput 
        withAsterisk
        required={true}
        label='Confirm password'
        {...form.getInputProps('confirmPassword')}
        style={{marginBottom: '10%'}}
        onInput={() => setRegisterError(false)}
      /> 
      <Center>
        <Button type="submit" color='teal'>
            Create account
        </Button>
      </Center>
    </form>
  );
}

export default RegisterForm;