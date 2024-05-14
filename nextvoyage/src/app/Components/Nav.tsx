import { useRouter } from "next/navigation";
import React from "react";

export const Nav = () => {
  const { push } = useRouter();

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
                className="md:hidden text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-lg inline-flex items-center justify-center"
                aria-controls="mobile-menu-3"
                aria-expanded="false"
              >
                <span className="sr-only">Open main menu</span>
                <svg
                  className="w-6 h-6"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                <svg
                  className="hidden w-6 h-6"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
            </div>
            <div
              className="hidden md:flex justify-between items-end w-full md:w-auto md:order-1"
              id="mobile-menu-3"
            >
              <ul className="flex-col items-center md:flex-row flex md:space-x-8 mt-4 md:mt-0 md:text-lg md:font-medium">
                <li>
                  <button
                    onClick={() => push(`/accueil`)}
                    className="text-gray-700 hover:bg-gray-50 border-b text-white border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:text-orangehover md:p-0"
                    aria-current="page"
                  >
                    Accueil
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => push(`/voyage`)}
                    className="text-gray-700 hover:bg-gray-50 border-b text-white border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:text-orangehover md:p-0"
                  >
                    Voyages
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => push(`/contact`)}
                    className=" text-orange hover:bg-gray-50 border-b border-gray-100 md:border-0 pl-3 pr-4 block md:text-white py-1.5 md:px-4 md:mr-2 h-fit rounded transition duration-200 bg-[#FF9029] md:hover:bg-[#FF7B00] hover:scale-105"
                  >
                    Contactez-nous
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>
    </div>
  );
};
