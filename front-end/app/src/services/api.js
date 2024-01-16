import axios from 'axios'

const ax = axios.create({
  //baseURL: 'http://127.0.0.1:5000',
   //baseURL: 'http://34.240.201.155:5000/',
   baseURL: 'http://localhost:8000/',
   headers: { 'Content-Type': 'application/json' }
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

export default ax