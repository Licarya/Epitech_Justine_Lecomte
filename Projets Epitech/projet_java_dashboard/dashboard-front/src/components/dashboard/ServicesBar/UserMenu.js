import { useCookies } from 'react-cookie';
import { useNavigate } from 'react-router-dom';

import { Menu, Avatar, Group } from '@mantine/core';

function UserMenu({userInfo}) {
  const navigate = useNavigate();
  const [cookies, setCookie, removeCookie] = useCookies();

  const logout = () => {
    removeCookie('JWT');
    navigate('/login');
  }

  return (
    <Menu 
      trigger="hover" 
      openDelay={10} 
      closeDelay={10} 
      position="right-end" 
      style={{cursor: 'pointer'}}
    >
      <Menu.Target>
        <Group style={{padding: '0em'}}>
          {
            userInfo.avatarUrl === null ? 
              <Avatar size='lg' radius='xl' /> :
              <Avatar size='lg' radius='xl' src={userInfo.avatarUrl} />
          }
          <div>
            <p style={{fontWeight: 500}}>{userInfo.name}</p>
            <p style={{color: 'gray', fontSize: '0.9em'}}>
              {userInfo.email}
            </p>
          </div>
        </Group>
      </Menu.Target>

      <Menu.Dropdown>
        <Menu.Item onClick={() => logout()}>
          <p style={{fontWeight: 400}}>Log out</p>
        </Menu.Item>
      </Menu.Dropdown>
    </Menu>
  )
}

export default UserMenu;