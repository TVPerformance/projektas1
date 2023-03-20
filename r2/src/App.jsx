import { useState } from 'react';
import { useEffect } from 'react';
import './App.css';
import List from "./Components/List";
import axios from 'axios';

function App() {

  const [mushrooms, setMushrooms] = useState([]);

  useEffect(() => {
   axios.get('http://mano.lt/api/grybai')
   .then(res => {
    //console.log(res.data.grybai)
    setMushrooms(res.data.grybai);
  })
  }, []);


  return (
    <List mushrooms={mushrooms} />
  );
}

export default App;
