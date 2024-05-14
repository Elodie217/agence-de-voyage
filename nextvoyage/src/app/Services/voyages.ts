import axios from "axios";

export async function getAllVoyages() {
  let axiosConfig = {
    headers: {
      "content-type": "application/json",
    },
  };

  let url = `${process.env.NEXT_PUBLIC_API_URL}api/voyages`;
  return axios.get(url, axiosConfig).then((res) => {
    return res;
  });
}

export async function getLastVoyages() {
  let axiosConfig = {
    headers: {
      "content-type": "application/json",
    },
  };

  let url = `${process.env.NEXT_PUBLIC_API_URL}api/voyage/derniers`;
  return axios.get(url, axiosConfig).then((res) => {
    return res;
  });
}

export async function getVoyagesByParameters(
  categorie: number | string,
  pays: number | string,
  ordre: string,
  dureeVoyage: number | string
) {
  let url = `${process.env.NEXT_PUBLIC_API_URL}api/voyage/parameters`;

  let axiosConfig = {
    headers: {
      "content-type": "application/json",
      // "Access-Control-Allow-Origin": "*",
      // "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS",
    },
  };

  return axios
    .post(
      url,
      {
        categorie: categorie,
        pays: pays,
        ordre: ordre,
        dureeVoyage: dureeVoyage,
      },
      axiosConfig
    )
    .then((res) => {
      return res;
    });
}

export async function getVoyageById(id: string) {
  let axiosConfig = {
    headers: {
      "content-type": "application/json",
    },
  };
  let url = `${process.env.NEXT_PUBLIC_API_URL}api/voyage/${id}`;

  return axios.delete(url, axiosConfig).then((res) => {
    return res;
  });
}
