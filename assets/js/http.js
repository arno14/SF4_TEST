import axios from 'axios';

const http = {
  countLoading: 0,
  onCountLoadingChangeFunction: () => {},
  onCountLoadingChange(callbackFunction) {
    this.onCountLoadingChangeFunction = callbackFunction;
  },
  request(method, uri, axiosConfig = {}) {
    const config = axiosConfig;
    config.url = uri;
    config.method = method;
    this.countLoading += 1;
    this.onCountLoadingChangeFunction(this.countLoading);
    return axios.request(config).finally(() => {
      this.countLoading -= 1;
      this.onCountLoadingChangeFunction(this.countLoading);
    });
  },
  get(uri, params) {
    return this.request('GET', uri, { params }).then((resp) => resp.data);
  },
  getList(uri, params) {
    return this.get(uri, { params }).then((data) => ({
      totalItems: data['hydra:totalItems'],
      member: data['hydra:member'],
    }));
  },
  patch(object) {
    const uri = object['@id'];
    const axiosConfig = {
      headers: {
        accept: 'application/ld+json',
        'Content-Type': 'application/merge-patch+json',
      },
    };
    axiosConfig.data = object;

    return this.request('PATCH', uri, axiosConfig);
  },
  save(object) {
    if (object['@id']) {
      return this.patch(object).then((resp) => resp.data);
    }
    throw new Error('unsupported');
  },
};

export default http;
