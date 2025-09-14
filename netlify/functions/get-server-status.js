import fetch from 'node-fetch';

exports.handler = async function(event, context) {
  try {
    const PTERO_URL_BASE = process.env.PTERO_URL_BASE;
    const PTERO_SERVER_UUID = process.env.PTERO_SERVER_UUID;
    const PTERO_API_KEY = process.env.PTERO_API_KEY;

    const url = `${PTERO_URL_BASE}/api/client/servers/${PTERO_SERVER_UUID}/utilization`;

    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${PTERO_API_KEY}`,
        'Accept': 'Application/vnd.pterodactyl.v1+json',
      },
    });

    if (!response.ok) {
      return {
        statusCode: response.status,
        body: JSON.stringify({ error: 'Error al contactar con la API de Pterodactyl.' }),
      };
    }

    const data = await response.json();

    return {
      statusCode: 200,
      body: JSON.stringify(data),
    };
  } catch (error) {
    return {
      statusCode: 500,
      body: JSON.stringify({ error: 'Error interno del servidor.' }),
    };
  }
};