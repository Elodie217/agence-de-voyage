import { useRouter } from "next/navigation";
import React from "react";
import { IoClose, IoMenu } from "react-icons/io5";

export const Nav = () => {
  const { push } = useRouter();

  function menu() {
    document.querySelector("#mobileMenu")?.classList.toggle("hidden");
    document.querySelector("#cross")?.classList.toggle("hidden");
    document.querySelector("#btnMenu")?.classList.toggle("hidden");
  }

  return (
    <div className=" ">
      <nav className="z-10 fixed w-full top-0 border-gray-200 p-2 px-4 bg-bleufonce">
        <div className="w-full mx-auto">
          <div className="mx-2 flex flex-wrap items-center justify-between">
            <button onClick={() => push(`/accueil`)} className="flex">
              <img
                src="/logoorange.png"
                alt="Logo"
                className="h-12 mx-4 my-2"
              />
              <span className="self-center text-xl font-semibold whitespace-nowrap text-white">
                In the sky
              </span>
            </button>
            <div className="flex md:hidden md:order-2">
              <button
                data-collapse-toggle="mobile-menu-3"
                type="button"
                className="md:hidden text-orange hover:text-hover rounded-lg inline-flex items-center justify-center"
                aria-controls="mobile-menu-3"
                aria-expanded="false"
                onClick={() => menu()}
              >
                <IoMenu id="btnMenu" className="w-6 h-6 " />
                <IoClose id="cross" className="w-6 h-6 hidden" />
              </button>
            </div>
            <div
              className="hidden md:flex justify-between items-end w-full md:w-auto md:order-1"
              id="mobileMenu"
            >
              <ul className="flex-col items-center md:flex-row flex md:space-x-8 mt-4 md:mt-0 md:text-lg md:font-medium">
                <li>
                  <button
                    onClick={() => push(`/accueil`)}
                    className="text-gray-700  border-b text-white border-gray-100  md:border-0 block pl-3 pr-4 py-2 hover:text-orangehover md:p-0"
                    aria-current="page"
                  >
                    Accueil
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => push(`/voyage`)}
                    className="text-gray-700 border-b text-white border-gray-100 md:border-0 block pl-3 pr-4 py-2 hover:text-orangehover md:p-0"
                  >
                    Voyages
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => push(`/contact`)}
                    className=" my-2 md:my-0 pl-3 pr-4 block text-white py-1.5 md:px-4 md:mr-2  h-fit rounded transition duration-200 bg-[#FF9029] hover:bg-[#FF7B00] hover:scale-105"
                  >
                    Contactez-nous
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  );
};
