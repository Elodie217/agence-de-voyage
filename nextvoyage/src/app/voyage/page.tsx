"use client";
import React, { useEffect, useState } from "react";
import { Nav } from "../Components/Nav";
import { IoIosArrowDropdown } from "react-icons/io";
import { useRouter } from "next/navigation";
import { getAllVoyages, getVoyagesByParameters } from "../Services/voyages";
import Footer from "../Components/Footer";
import { getAllCategories } from "../Services/categories";
import { getAllPays } from "../Services/pays";
import { Bars } from "react-loader-spinner";

const page = () => {
  const [voyagesList, setVoyagesList] = useState([]);
  const [categoriesList, setCategoriesList] = useState([]);
  const [paysList, setPaysList] = useState([]);

  const [isLoading, setIsLoading] = useState(false);

  const { push } = useRouter();

  const [categorie, setCategories] = useState<number | string>("all");
  const [pays, setPays] = useState<number | string>("all");
  const [ordre, setOrdre] = useState<string>("all");
  const [dureeVoyage, setDureeVoyage] = useState<number | string>("all");

  useEffect(() => {
    setIsLoading(true);

    getAllVoyages().then((res: any) => {
      setVoyagesList(res.data);
    });
    getAllCategories().then((res: any) => {
      setCategoriesList(res.data);
    });
    getAllPays().then((res: any) => {
      setPaysList(res.data);
      setIsLoading(false);
    });
  }, []);

  useEffect(() => {
    setIsLoading(true);

    getVoyagesByParameters(categorie, pays, ordre, dureeVoyage).then(
      (res: any) => {
        setVoyagesList(res.data);
        setIsLoading(false);
      }
    );
  }, [categorie, pays, ordre, dureeVoyage]);

  return (
    <main className=" text-lg">
      <section className="h-screen">
        <Nav></Nav>

        <section
          className="flex flex-col items-center h-full pt-20 bg-cover bg-center"
          style={{
            backgroundImage: `url(https://images.unsplash.com/photo-1498550744921-75f79806b8a7?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)`,
          }}
        >
          <h1
            className=" pt-[15vh] text-center text-6xl font-semibold text-bleufonce "
            style={{ textShadow: "0px 0px 20px white" }}
          >
            {/* <div className="bg-[#ffffffa3] p-2 rounded-lg"> */}
            <span>
              Au-delà des Nuages, <br /> Découvrez nos Voyages
            </span>
            {/* </div> */}
          </h1>
          <a
            href="#voyages"
            className="mt-[25vh] sm:mt-[40vh] transform hover:scale-125 transition duration-200 hover:cursor-pointer"
          >
            <IoIosArrowDropdown color="#fff" size={46} />
          </a>
          <div id="voyages"></div>
        </section>
      </section>
      <section>
        <section className=" m-6 flex justify-between">
          <div>
            <select
              name="pays"
              id=""
              className="mx-6 w-fit rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
              onChange={(e) => {
                setPays(e.target.value);
              }}
            >
              <option value="all">Pays</option>
              {paysList &&
                paysList.map((pays: any) => {
                  return <option value={pays.id}>{pays.nom_pays}</option>;
                })}
            </select>
            <select
              name="categories"
              id=""
              className="mx-6 w-fit rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
              onChange={(e) => {
                setCategories(e.target.value);
              }}
            >
              <option value="all">Catégories</option>
              {categoriesList &&
                categoriesList.map((categorie: any) => {
                  return (
                    <option value={categorie.id}>
                      {categorie.nom_categorie}
                    </option>
                  );
                })}
            </select>
          </div>

          <div className="flex items-center">
            <select
              name="jours"
              id=""
              className="mx-6 w-fit rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
              onChange={(e) => {
                setOrdre(e.target.value);
              }}
            >
              <option value="all">Durée</option>
              <option value="min">Minimum</option>
              <option value="max">Maximum</option>
            </select>
            <input
              type="number"
              className=" w-20 rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
              onChange={(e) => {
                setDureeVoyage(e.target.value);
                console.log(e.target.value);
              }}
            />
            <p className="mx-6">jours</p>
          </div>
        </section>

        <div className="relative pt-2 lg:pt-2 ">
          {isLoading ? (
            <div className="w-full h-56 flex  justify-center">
              <Bars
                height="80"
                width="80"
                color="#082A33"
                ariaLabel="bars-loading"
                wrapperStyle={{}}
                wrapperClass=""
                visible={true}
              />
            </div>
          ) : voyagesList.length > 0 ? (
            <div className="bg-cover w-full flex justify-center items-center">
              <div className="w-full backdrop-filter backdrop-blur-lg">
                <div className="w-12/12 mx-auto rounded-2xl  p-5 backdrop-filter backdrop-blur-lg">
                  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-20 px-12 mx-auto">
                    {voyagesList &&
                      voyagesList.map((voyage: any) => {
                        return (
                          <article className="bg-white  p-6 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border border-bleufonce">
                            <button
                              onClick={() => push(`/voyage/` + voyage.id)}
                              className="absolute opacity-0 top-0 right-0 left-0 bottom-0"
                            ></button>
                            <div className="relative mb-4 rounded-2xl">
                              <img
                                className="max-h-48 rounded-2xl w-full object-cover transition-transform duration-300 transform group-hover:scale-105 shadow-2xl"
                                src={voyage.image_voyage}
                                alt=""
                              />
                              <div className="absolute bottom-3 left-3 inline-flex items-center rounded-lg bg-white p-2 shadow-md">
                                <i className="fa-regular fa-calendar"></i>
                                <span className="ml-1 text-sm">
                                  {voyage.duree_voyage} jours
                                </span>
                              </div>

                              <button
                                className="flex justify-center items-center bg-[#FF9029] bg-opacity-80 z-10 absolute top-0 left-0 w-full h-full text-white rounded-2xl opacity-0 transition-all duration-300 transform group-hover:scale-105 text-xl group-hover:opacity-100"
                                onClick={() => push(`/voyage/` + voyage.id)}
                                rel="noopener noreferrer"
                              >
                                Découvrir le voyage
                                <svg
                                  className="ml-2 w-6 h-6"
                                  fill="none"
                                  stroke="currentColor"
                                  viewBox="0 0 24 24"
                                  xmlns="http://www.w3.org/2000/svg"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 5l7 7-7 7M5 5l7 7-7 7"
                                  ></path>
                                </svg>
                              </button>
                            </div>
                            <div className="flex w-full pb-4 mb-auto">
                              <p className=" font-bold text-xl group-hover:text-[#FF9029] transition-colors duration-200 ">
                                {voyage.destination_voyage}
                              </p>
                            </div>

                            <p className=" text-justify mb-4 text-base">
                              {voyage.description_voyage.length > 100
                                ? voyage.description_voyage.slice(0, 150) +
                                  "..."
                                : voyage.description_voyage}
                            </p>
                            <div className=" flex justify-between items-end">
                              <div className="max-w-[50%] mr-2">
                                <p className="rounded-lg bg-white p-2 my-1  shadow-md">
                                  {voyage.pays.map((pays: any, index: any) => (
                                    <span>
                                      {pays.nom_pays}
                                      {index !== voyage.pays.length - 1 && ", "}
                                    </span>
                                  ))}
                                </p>
                              </div>
                              <div className="max-w-[50%] ml-2">
                                <p className="rounded-lg bg-white p-2 my-1  shadow-md">
                                  {voyage.categorie.map(
                                    (categorie: any, index: any) => (
                                      <span>
                                        {categorie.nom_categorie}
                                        {index !==
                                          voyage.categorie.length - 1 && ", "}
                                      </span>
                                    )
                                  )}
                                </p>
                              </div>
                            </div>
                          </article>
                        );
                      })}
                  </div>
                </div>
              </div>
            </div>
          ) : (
            <div className="mt-6 mb-12 text-2xl text-center">
              Désolé aucun voyage ne correspond à votre recherche.
            </div>
          )}
        </div>
      </section>
      <Footer></Footer>
    </main>
  );
};

export default page;
