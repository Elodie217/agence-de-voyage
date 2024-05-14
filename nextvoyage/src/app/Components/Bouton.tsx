"use client";
import { useRouter } from "next/navigation";
import React from "react";

type BoutonProps = {
  title: string;
  route: string;
};

export const Bouton = ({ title, route }: BoutonProps) => {
  const { push } = useRouter();
  return (
    <button
      onClick={() => {
        push(route);
      }}
      className={`pl-3 pr-4 block text-white py-1.5 px-4 mr-2 h-fit rounded transition duration-200 bg-[#FF9029] hover:bg-[#FF7B00] hover:scale-105`}
    >
      {title}{" "}
    </button>
  );
};
