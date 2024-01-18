import axios from 'axios'

localStorage.setItem('token', "eyJ0eXAiOiJKV1QiLCJleHBpcmVzX2luIjoiMTBoIiwiYWxnIjoiSFMyNTYifQ.eyJpZCI6MSwibmFtZSI6ImFkbWluIiwiZW1haWwiOiJhZG1pbiJ9.kr5rLFop9leiJW1n0E-LYB6qLncfK-Kp_C7cvIrOQ-0")
console.log(localStorage.getItem('token'))
axios.defaults.baseURL = 'http://localhost:8000/';
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token'); 
//import { Axis } from "@amcharts/amcharts5/.internal/charts/xy/axes/Axis";

const ax = axios.create({
  //baseURL: 'http://127.0.0.1:5000',
   //baseURL: 'http://34.240.201.155:5000/',
   baseURL: 'http://localhost:8000/',
   headers: { Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJleHBpcmVzX2luIjoiMTBoIiwiYWxnIjoiSFMyNTYifQ.eyJpZCI6MSwibmFtZSI6ImFkbWluIiwiZW1haWwiOiJhZG1pbiJ9.kr5rLFop9leiJW1n0E-LYB6qLncfK-Kp_C7cvIrOQ-0', 'Content-Type': 'application/json'}
})

export const fetchData = async (url) => {
  try {
    const response = await ax.get(url);
    return response.data;
  } catch (error) {
    console.error('Erreur lors de la récupération des données:', error);
    throw error;
  }
}

/*export const fetchData = async (url, option) => {
  try {
    const response = await fetch(`http://localhost:8000/${url}`, option);

    if (!response.ok) {
      throw new Error(`Erreur HTTP: ${response.status}`);
    }

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Erreur lors de la récupération des données:', error);
    throw error;
  }
}
*/
export default ax