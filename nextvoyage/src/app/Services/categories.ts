import axios from "axios";

export async function getAllCategories() {
  let axiosConfig = {
    headers: {
      "content-type": "application/json",
    },
  };

  let url = `${process.env.NEXT_PUBLIC_API_URL}api/categories`;
  return axios.get(url, axiosConfig).then((res) => {
    return res;
  });
}
