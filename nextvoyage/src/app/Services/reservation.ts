import axios from "axios";
import { formulaireProps } from "../Utils/types";

export async function envoieFormulaire(formulaire: formulaireProps) {
  let url = `${process.env.NEXT_PUBLIC_API_URL}api/reservation/new`;

  let axiosConfig = {
    headers: {
      "content-type": "application/json",
    },
  };
  return axios
    .post(
      url,
      {
        nom_utilisateur: formulaire.nom,
        prenom_utilisateur: formulaire.prenom,
        email: formulaire.email,
        tel_utilisateur: formulaire.tel,
        adv_voyage_id: formulaire.voyage,
        message_reservation: formulaire.message,
      },
      axiosConfig
    )
    .then((res) => {
      return res;
    });
}
