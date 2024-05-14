export type voyageProps = {
  id: number;
  destination_voyage: string;
  duree_voyage: string;
  image_voyage: string;
  imagebis_voyage: string;
  description_voyage: string;
  pays: Array<string>;
  categorie: Array<string>;
};

export type formulaireProps = {
  nom: string;
  prenom: string;
  email: string;
  tel: string;
  voyage: string;
  message: string;
};
