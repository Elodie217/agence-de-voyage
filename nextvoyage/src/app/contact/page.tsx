"use client";
import React, { useEffect, useState } from "react";
import { Nav } from "../Components/Nav";
import { Bouton } from "../Components/Bouton";
import { IoIosArrowDropdown } from "react-icons/io";
import Footer from "../Components/Footer";
import { getAllVoyages } from "../Services/voyages";
import { envoieFormulaire } from "../Services/reservation";
import toast, { Toaster } from "react-hot-toast";

const page = () => {
  const [voyagesList, setVoyagesList] = useState([]);

  const [nom, setNom] = useState("");
  const [prenom, setPrenom] = useState("");
  const [email, setEmail] = useState("");
  const [tel, setTel] = useState("");
  const [voyage, setVoyage] = useState("");
  const [message, setMessage] = useState("");

  useEffect(() => {
    getAllVoyages().then((res: any) => {
      setVoyagesList(res.data);
      console.log(res.data);
    });
  }, []);

  function envoyerForm() {
    if (
      nom !== "" &&
      prenom !== "" &&
      email !== "" &&
      tel !== "" &&
      voyage !== "" &&
      message !== ""
    ) {
      document.querySelector(".erreurForm")!.innerHTML = "";
      if (message.length <= 500) {
        if (checkEmail(email)) {
          let formulaire = {
            nom: nom,
            prenom: prenom,
            email: email,
            tel: tel,
            voyage: voyage,
            message: message,
          };

          envoieFormulaire(formulaire).then((res) => {
            console.log(formulaire);
            if (res.status === 201) {
              toast.success("Votre message a été envoyé.");
            }
          });
        } else {
          document.querySelector(".erreurForm")!.innerHTML =
            "Merci de rentrer un email valide.";
        }
      } else {
        document.querySelector(".erreurForm")!.innerHTML =
          "Votre message ne doit pas excéder 500 caractères.";
      }
    } else {
      document.querySelector(".erreurForm")!.innerHTML =
        "Merci de remplir tous les champs.";
    }
  }

  function checkEmail(email: string) {
    let re =
      /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }

  return (
    <main className=" text-lg">
      <section className="h-screen">
        <Nav></Nav>
        <Toaster position="top-right"></Toaster>

        <section className=" flex flex-col items-center h-full pt-20 bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1528832439115-7cc3bd6d4100?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')]">
          <h1
            className=" pt-14 text-center text-5xl font-semibold text-bleufonce"
            // style={{ textShadow: "0px 0px 20px white" }}
          >
            <div className="bg-[#ffffffa3] p-2 rounded-lg mx-4">
              Commencez votre aventure ici
            </div>
          </h1>

          <a
            href="#form"
            className="  sm:block mt-[45vh] sm:mt-[55vh] md:mt-[60vh] transform hover:scale-125 transition duration-200 hover:cursor-pointer"
          >
            <IoIosArrowDropdown color="#fff" size={46} />
          </a>
          <div id="form"></div>
        </section>
      </section>

      {/* formulaire */}
      <section>
        <div className="flex items-center justify-center p-12 ">
          <div className="mx-auto w-full max-w-[550px] shadow-2xl p-6 rounded-xl">
            <div className="-mx-3 flex flex-wrap ">
              <div className="w-full px-3 sm:w-1/2">
                <div className="mb-5">
                  <label className='mb-3 block text-base font-medium text-[#07074D]"'>
                    Nom
                  </label>
                  <input
                    type="text"
                    className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
                    onChange={(e) => setNom(e.target.value)}
                  />
                </div>
              </div>
              <div className="w-full px-3 sm:w-1/2">
                <div className="mb-5">
                  <label className='mb-3 block text-base font-medium text-[#07074D]"'>
                    Prénom
                  </label>
                  <input
                    type="text"
                    className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
                    onChange={(e) => setPrenom(e.target.value)}
                  />
                </div>
              </div>
            </div>
            <div className="mb-5">
              <label className='mb-3 block text-base font-medium text-[#07074D]"'>
                Email
              </label>
              <input
                type="email"
                className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
                onChange={(e) => setEmail(e.target.value)}
              />
            </div>

            <div className="-mx-3 flex flex-wrap">
              <div className="w-full px-3 sm:w-1/2">
                <div className="mb-5">
                  <label className='mb-3 block text-base font-medium text-[#07074D]"'>
                    Téléphone
                  </label>
                  <input
                    type="text"
                    className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
                    onChange={(e) => setTel(e.target.value)}
                  />
                </div>
              </div>
            </div>

            <div className="mb-5">
              <label className='mb-3 block text-base font-medium text-[#07074D]"'>
                Quel voyage vous intéresse ?
              </label>
              <select
                name="choixVoyage"
                className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
                onChange={(e) => setVoyage(e.target.value)}
              >
                <option value="">...</option>
                {voyagesList &&
                  voyagesList.map((voyage: any) => {
                    return (
                      <option value={voyage.id}>
                        {voyage.destination_voyage}
                      </option>
                    );
                  })}
              </select>
            </div>

            <div className="mb-5">
              <label className='mb-3 block text-base font-medium text-[#07074D]"'>
                Votre message
              </label>
              <textarea
                className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-orange focus:shadow-md"
                onChange={(e) => setMessage(e.target.value)}
              />
            </div>

            <div className="erreurForm text-red mb-6"></div>

            <button
              onClick={() => envoyerForm()}
              className="block text-white py-1.5 px-4 h-fit rounded transition duration-200 bg-[#FF9029] hover:bg-[#FF7B00] text-lg w-fit m-auto"
            >
              Envoyer
            </button>
          </div>
        </div>
      </section>
      <Footer></Footer>
    </main>
  );
};

export default page;
