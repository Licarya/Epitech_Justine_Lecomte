import { Card, Divider } from "@mantine/core";
import LoginHeader from "../components/login/LoginHeader";
import OAuth2Buttons from "../components/login/OAuth2Buttons";
import LoginForm from "../components/login/LoginForm";
import LoginFooter from "../components/login/LoginFooter";

function Login() {
  return (
      <Card shadow="md"
            radius="md" 
            style={{
                width: '40%',
                height: '80vh',
                marginLeft: '30%', 
                marginTop: '10vh',
                paddingLeft: 60,
                paddingRight: 60,
                paddingTop: 30
            }}>
        <LoginHeader />
        <OAuth2Buttons />
        <Divider my="xs" label="or" labelPosition="center"></Divider>
        <LoginForm />
        <LoginFooter />
      </Card>
  );
}

export default Login;