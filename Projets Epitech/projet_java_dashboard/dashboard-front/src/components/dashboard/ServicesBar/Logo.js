import { Group, Image } from '@mantine/core';

function Logo() {
  return (
    <Group>
      <div style={{width: 40}}>
      <Image                
          src="dashboard-logo.png"
          alt="Developer board logo"
      />
      </div>
      <h3 style={{marginLeft: '1%'}}>Developer Board</h3>
    </Group>
  )
}

export default Logo;