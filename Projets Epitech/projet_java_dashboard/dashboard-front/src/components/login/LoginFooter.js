import { Link } from 'react-router-dom';

function LoginFooter() {
  return (
    <div style={{
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center'
    }}>
      <p>Don't have an account?</p>
      <Link to='/register'>Create account</Link>
    </div>
  );
}

export default LoginFooter;