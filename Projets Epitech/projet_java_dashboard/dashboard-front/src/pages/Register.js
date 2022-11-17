import { Card, Center, Divider } from "@mantine/core";
import LoginHeader from "../components/login/LoginHeader";
import OAuth2Buttons from "../components/login/OAuth2Buttons";
import RegisterFooter from "../components/register/RegisterFooter";
import RegisterForm from "../components/register/RegisterForm";

function Register() {
    return (
        <Card shadow="md"
            radius="md" 
            style={{
                width: '60%',
                height: '80vh',
                marginLeft: '20%', 
                marginTop: '10vh',
                paddingLeft: 60,
                paddingRight: 60,
                paddingTop: 30
            }}>
        <div style={{
          display: 'flex', 
          flexDirection: 'row', 
          alignItems: 'center',
          height: '80%'
        }}>
          <div style={{width: '45%', marginRight: '4%'}}>
            <LoginHeader />
            <OAuth2Buttons />
          </div>
          <Divider 
            my='xs' 
            orientation='vertical' 
            label='or'
            labelPosition='center'
            style={{width: '2%'}}
          />
          <div style={{width: '45%', marginLeft: '4%'}}>
            <RegisterForm />
          </div>
        </div>
        <Center style={{marginTop: '5%'}}>
          <RegisterFooter />
        </Center>
      </Card>
    );
}

export default Register;