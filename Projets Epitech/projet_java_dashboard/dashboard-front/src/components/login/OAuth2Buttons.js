import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import { Center, Button, ThemeIcon } from '@mantine/core';
import { IconBrandGithub, IconBrandGoogle } from '@tabler/icons';

function OAuth2Buttons() {
  const navigate = useNavigate();

  const onGoogleClick = () => {
    axios.get('http://localhost:8080/gmail/connect')
      .then(() => navigate('/'))
      .catch(err => console.error(err));
  }

  return (
    <Center style={{
      marginTop: 15,
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
    }}>
      <a href='http://localhost:8080/oauth2/authorization/github'>
        <Button variant='default' size='md' style={{marginTop: 10, marginBottom: 5}}>
          <ThemeIcon variant='default' style={{border: 0, marginRight: 10}}>
            <IconBrandGithub />
          </ThemeIcon>
          <p>Continue with Github</p>
        </Button>
      </a>
      <a href='http://localhost:8080/oauth2/authorization/google'>
        <Button 
          variant='default' 
          size='md' 
          style={{marginTop: 10, marginBottom: 5}} 
          onClick={() => onGoogleClick()}
        >
          <ThemeIcon variant='default' style={{border: 0, marginRight: 10}}>
            <IconBrandGoogle />
          </ThemeIcon>
          <p>Continue with Google</p>
        </Button>
      </a>
    </Center>
  );
}

export default OAuth2Buttons;