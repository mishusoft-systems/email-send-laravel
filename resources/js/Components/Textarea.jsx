import React, {useEffect, useRef} from 'react';

export default function Textarea({
                                     rows = 4,
                                     name,
                                     value,
                                     className,
                                     autoComplete,
                                     required,
                                     isFocused,
                                     handleChange,
                                     placeholder,
                                 }) {
    const input = useRef();

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    return (
        <div className="flex flex-col items-start">
            <textarea
                id="message" name={name} rows={rows} placeholder={placeholder} ref={input} autoComplete={autoComplete}
                required={required}
                className={`block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500` + className}
                onChange={(e) => handleChange(e)} value={value}></textarea>
        </div>
    );
}
