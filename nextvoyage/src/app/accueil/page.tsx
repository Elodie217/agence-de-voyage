"use client";

import { IoIosArrowDropdown } from "react-icons/io";

import { useEffect, useState } from "react";
import { useRouter } from "next/navigation";
import { Bars } from "react-loader-spinner";
import { getLastVoyages } from "../Services/voyages";
import { Nav } from "../Components/Nav";
import { Bouton } from "../Components/Bouton";
import Footer from "../Components/Footer";

export default function Home() {
  const [voyagesList, setVoyagesList] = useState([]);
  const { push } = useRouter();

  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    setIsLoading(true);

    getLastVoyages().then((res: any) => {
      setVoyagesList(res.data);
      setIsLoading(false);
    });
  }, []);

  return (
    <main className=" text-lg">
      <section className="h-screen">
        <Nav></Nav>

        <section className=" flex flex-col items-center h-full pt-20 bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1581135146146-d4c94d848c1c?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')]">
          <h1 className=" pt-24 text-center text-5xl font-semibold text-bleufonce">
            In the sky
          </h1>
          <p
            // style={"text-shadow : 3px 3px 20px white"}
            className="text-white text-center text-3xl px-6 mt-40 md:mt-36"
          >
            Découvrez l'aventure à chaque destination : <br /> votre voyage de
            rêve commence ici.
          </p>
          <div className=" mt-12 md:mt-16">
            <Bouton
              title={"Réservez dès maintenant"}
              route={"/contact"}
            ></Bouton>
          </div>
          <a
            href="#dernierVoyage"
            className=" hidden sm:block mt-8 transform hover:scale-125 transition duration-200 hover:cursor-pointer"
          >
            <IoIosArrowDropdown color="#fff" size={46} />
          </a>
        </section>
      </section>
      {/* Les derniers voyages */}
      <section className=" bg-vertclaire" id="dernierVoyage">
        <h2 className=" text-2xl font-semibold p-6">
          Découvrez nos derniers voyages
        </h2>
        {isLoading && (
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
        )}
        <section>
          <div className="relative pt-2 lg:pt-2 ">
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
          </div>
        </section>
      </section>

      {/* Présentation agence */}

      <section className="md:flex items-center">
        <img
          className=" lg:w-1/4 md:w-2/5 w-3/4 my-16 lg:mx-28 md:ml-10 md:mr-5 m-auto rounded-xl shadow-2xl"
          src="https://images.pexels.com/photos/954929/pexels-photo-954929.jpeg"
          alt=""
        />

        <p className=" w-3/4  text-justify lg:mr-28 md:mx-10 m-auto my-8">
          <span className="font-semibold">
            {" "}
            Bienvenue chez
            <span className="italic"> In The Sky</span> !
          </span>{" "}
          <br /> <br />À <span className="italic">In The Sky</span>, nous ne
          vendons pas seulement des voyages, nous vous offrons une expérience de
          vie. Embarquez avec nous pour découvrir les merveilles du monde,
          explorer des cultures fascinantes et créer des souvenirs inoubliables
          dans les coins les plus enchanteurs de la planète. <br /> <br />
          Notre équipe passionnée est là pour vous guider à travers chaque étape
          de votre voyage, des premières étincelles d'inspiration à la
          réalisation de vos rêves les plus fous. Que vous soyez à la recherche
          d'une aventure audacieuse, d'une escapade romantique, ou simplement
          d'une pause bien méritée loin du quotidien, nous avons le voyage
          parfait pour vous. <br /> <br />
        </p>
      </section>
      <section className="flex md:flex-row flex-col-reverse items-center">
        <p className=" w-3/4 text-justify lg:ml-28 md:mx-10 m-auto my-8">
          Chez <span className="italic">In The Sky</span>, nous croyons que
          chaque destination a une histoire à raconter et chaque voyageur une
          aventure à vivre. Laissez-nous vous emmener vers de nouveaux horizons,
          où les possibilités sont infinies et où le ciel est la seule limite.{" "}
          <br /> <br />
          Préparez-vous à vous envoler vers des horizons lointains, à explorer
          des paysages à couper le souffle et à créer des souvenirs qui dureront
          toute une vie. Avec <span className="italic">In The Sky</span>, votre
          prochaine grande aventure vous attend juste au coin de la rue. <br />{" "}
          <br />
          Prêt·e à prendre votre envol ? Contactez-nous dès aujourd'hui et
          laissez-nous transformer vos rêves en réalité. <br /> <br />
          Bienvenue à bord,
          <br /> <br />
          L'équipe <span className="italic">In The Sky</span>
        </p>
        <img
          className=" lg:w-1/4 md:w-2/5 w-3/4 my-16 lg:mx-28 md:mr-10 md:ml-5 m-auto rounded-xl shadow-2xl"
          src="https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt=""
        />
      </section>
      <div className="flex justify-center text-2xl mb-16">
        <Bouton title={"Contactez-nous"} route={"/contact"}></Bouton>
      </div>
      <Footer></Footer>
    </main>
  );
}
