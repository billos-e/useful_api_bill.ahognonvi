import axios from 'axios';
const URL = 'http://127.0.0.1:8000/api';

export const apiService = axios.create({
  baseURL: URL,
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
});

export const setToken = (token) => {
    apiService.defaults.headers.common['Authorization'] = `Bearer ${token ?? ''}`;
}

export const removeToken = () => {
    apiService.defaults.headers.common['Authorization'] = 'Bearer  ';
}

