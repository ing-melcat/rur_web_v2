const StoreApi = (() => {
  const parseJson = async (response) => {
    const data = await response.json().catch(() => ({ ok: false, message: 'Respuesta inválida del servidor.' }));
    if (!response.ok || data.ok === false) {
      throw new Error(data.message || 'Ocurrió un error.');
    }
    return data;
  };

  const post = async (url, payload = {}) => {
    const response = await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload),
      credentials: 'same-origin',
    });
    return parseJson(response);
  };

  const get = async (url) => {
    const response = await fetch(url, { credentials: 'same-origin' });
    return parseJson(response);
  };

  const mxn = (value) => new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(Number(value || 0));

  return { post, get, mxn };
})();
