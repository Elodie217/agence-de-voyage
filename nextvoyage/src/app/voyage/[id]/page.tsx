"use client";

import { Bouton } from "@/app/Components/Bouton";
import Footer from "@/app/Components/Footer";
import { Nav } from "@/app/Components/Nav";
import { getVoyageById } from "@/app/Services/voyages";
import { voyageProps } from "@/app/Utils/types";
import { useRouter } from "next/navigation";
import React, { useEffect, useState } from "react";
import { FaUmbrellaBeach } from "react-icons/fa";
import { IoIosArrowDropdown } from "react-icons/io";
import { LiaMountainSolid } from "react-icons/lia";
import { PiBuildingsLight } from "react-icons/pi";
import { TbCarGarage } from "react-icons/tb";

const Page = ({ params }: { params: { id: string } }) => {
  const [voyage, setVoyage] = useState<voyageProps>();
  const { push } = useRouter();

  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    setIsLoading(true);

    getVoyageById(params.id).then((res: any) => {
      setVoyage(res.data);
      setIsLoading(false);
    });
  }, []);

  return (
    <main className=" text-lg">
      <section className="h-screen">
        <Nav></Nav>

        <section
          className="flex flex-col items-center h-full pt-20 bg-cover bg-center"
          style={{ backgroundImage: `url(${voyage?.image_voyage})` }}
        >
          <h1 className=" pt-[30vh] text-center text-6xl font-semibold text-bleufonce mx-40 ">
            <div className="bg-[#ffffffa3] p-2 rounded-lg">
              <span>{voyage?.destination_voyage}</span>
            </div>
          </h1>
          <a
            href="#voyage"
            className=" mt-[20vh] sm:mt-[28vh] transform hover:scale-125 transition duration-200 hover:cursor-pointer"
          >
            <IoIosArrowDropdown color="#fff" size={46} />
          </a>
          <div id="voyage"></div>
        </section>
      </section>
      <section className=" py-16 md:px-36 sm:px-20 px-10">
        <div className=" flex items-center mb-6">
          <h2 className="text-2xl font-semibold  ">
            {voyage?.destination_voyage}
          </h2>
          <div className="inline-flex items-center rounded-lg bg-white p-2 ml-6 shadow-md">
            <i className="fa-regular fa-calendar"></i>
            <span className="ml-1 text-sm">{voyage?.duree_voyage} jours</span>
          </div>
        </div>

        <p className="text-justify">{voyage?.description_voyage}</p>
      </section>
      <section className="lg:flex items-center justify-between lg:px-56">
        <span className=" ">
          <img
            src={voyage?.imagebis_voyage}
            alt="Paysage"
            className="max-h-[90vh] m-auto rounded-xl shadow-2xl"
          />
        </span>
        <div className=" w-fit m-auto">
          <div className=" rounded-lg bg-white p-2 shadow-md mt-10 lg:mb-40 mb-10 lg:mr-36">
            <h3 className="m-2 font-bold">Pays à découvrir :</h3>
            <p className="m-2">
              {voyage?.pays.map((pays: any, index: any) => (
                <span>
                  {pays.nom_pays}
                  {index !== voyage.pays.length - 1 && ", "} <br />
                </span>
              ))}
            </p>
          </div>
          <div className=" rounded-lg bg-white p-2 shadow-md lg:mt-40 mt-10 mb-10 lg:mr-36">
            <h3 className="m-2 font-bold">Catégories :</h3>
            <p className="m-2">
              {voyage?.categorie.map((categorie: any) => (
                <span className="flex items-center">
                  {categorie.nom_categorie == "Montage" ? (
                    <span className=" mr-2 text-xl">
                      <LiaMountainSolid />
                    </span>
                  ) : (
                    ""
                  )}
                  {categorie.nom_categorie == "Ville" ? (
                    <span className=" mr-2 text-xl">
                      <PiBuildingsLight />
                    </span>
                  ) : (
                    ""
                  )}
                  {categorie.nom_categorie == "Road Trip" ? (
                    <span className=" mr-2 text-xl">
                      <TbCarGarage />
                    </span>
                  ) : (
                    ""
                  )}
                  {categorie.nom_categorie == "Mer" ? (
                    <span className=" mr-2 text-xl">
                      <FaUmbrellaBeach />
                    </span>
                  ) : (
                    ""
                  )}

                  {categorie.nom_categorie}
                  <br />
                </span>
              ))}
            </p>
          </div>
        </div>
      </section>
      <div className="flex justify-center text-2xl my-16">
        <Bouton title={"Contactez-nous"} route={"/contact"}></Bouton>
      </div>
      <Footer></Footer>
    </main>
  );
};

export default Page;
