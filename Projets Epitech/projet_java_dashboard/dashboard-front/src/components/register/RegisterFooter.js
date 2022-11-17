import { Link } from 'react-router-dom';

function RegisterFooter() {
  return (
    <div style={{
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center'
    }}>
      <p>Already have an account?</p>
      <Link to='/login'>Log in</Link>
    </div>
  );
}

export default RegisterFooter;