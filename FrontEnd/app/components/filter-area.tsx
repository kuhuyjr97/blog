import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCaretDown } from "@fortawesome/free-solid-svg-icons";
import Input from "@/app/components/input";
const FilterArea = () => {
  return (
    <main className=" ">
      <div className="flex  ">
        <div className="text-xl">
          <FontAwesomeIcon icon={faCaretDown} />
        </div>
        <span className="px-2 text-xl">Filter</span>
      </div>

      <div className="">
        <Input label="Member name" type="text" />
      </div>
    </main>
  );
};

export default FilterArea;
