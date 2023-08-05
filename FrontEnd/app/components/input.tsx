import React from "react";

interface Inputprops {
  label: string;
  type: string;
  value?: string;
  onChange?: (e: React.ChangeEvent<HTMLInputElement>) => void;
  placeholder?: string;
}

const Input: React.FC<Inputprops> = ({
  label,
  type,
  value,
  onChange,
  placeholder,
}) => {
  return (
    <div className=" flex flex-col lg:block ">
      <label className="text-xl mt-1">{label}</label>
      <input
        type={type}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        className="border border-gray-500 p-2 rounded-sm"
      />
    </div>
  );
};

export default Input;
