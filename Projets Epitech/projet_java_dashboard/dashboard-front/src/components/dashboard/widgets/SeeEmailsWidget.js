import axios from 'axios';
import { useEffect } from 'react';

function SeeEmailsWidget() {

  useEffect(() => {
    axios.get('http://localhost:8080/gmail')
      .then(response => console.log(response))
      .catch(err => console.log(err));
  }, [])

  return (
    <div>SeeEmailsWidget</div>
  )
}

export default SeeEmailsWidget;