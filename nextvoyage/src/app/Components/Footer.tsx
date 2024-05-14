import React from "react";

const Footer = () => {
  return (
    <section className=" bg-vertclaire text-bleufonce ">
      <div className="flex flex-wrap justify-around text-base/[30px] p-6 mt-4">
        <img src="/logoorange.png" alt="" className=" h-24 mx-4 my-2" />
        <p className="m-4">
          Mentions légales <br /> <br />
          Politiques de confidentialité
        </p>
        <p className="m-4">
          "In The Sky Travel Agency" <br />
          217 Avenue des Aventuriers <br />
          Cité des Rêves, Pays des Merveilles
        </p>
      </div>
      <p className="px-5 py-3 mr-4 text-xs text-[#FF9029] text-end">
        Copyright ITSTA@2023
      </p>
    </section>
  );
};

export default Footer;
