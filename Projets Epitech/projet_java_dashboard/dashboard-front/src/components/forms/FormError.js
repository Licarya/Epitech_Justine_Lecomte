import { Center } from '@mantine/core';

function FormError({ message }) {
  return (
    <Center>
      <p style={{color: '#f03e3e', fontWeight: '600'}}>{message}</p>
    </Center>
  );
}

export default FormError;