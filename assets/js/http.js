import axios from 'axios';

const http = {
  get(uri, params) {
    return axios.get(uri, { params }).then((resp) => resp.data);
  },
  getList(uri, params) {
    return axios.get(uri, { params }).then((resp) => ({
      totalItems: resp.data['hydra:totalItems'],
      member: resp.data['hydra:member'],
    }));
  },
  patch(object) {
    const uri = object['@id'];
    return axios.patch(uri, object, {
      headers: {
        accept: 'application/ld+json',
        'Content-Type': 'application/merge-patch+json',
      },
    });
  },
  save(object) {
    if (object['@id']) {
      return this.patch(object).then((resp) => resp.data);
    }
    throw new Error('unsupported');
  },
};

export default http;
