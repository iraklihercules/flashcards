"use client";

import { useState, useEffect } from 'react';
import { parseISO, format } from 'date-fns';

export default function Page() {
    const [categories, setCategories] = useState([]);

    useEffect(() => {
        fetchCategories();
    }, []);

    const fetchCategories = () => {
        const url = `http://localhost:8051/api/categories`;

        fetch(url, {cache: "no-store"})
            .then((res) => { return res.json(); })
            .then((data) => { setCategories(data); });
    };

    return (
        <>
            <h1 className={'text-3xl text-zinc-400 p-8'}>Categories</h1>

            <div className={'mt-8 text-zinc-500 px-8'}>
                <div className={'grid grid-cols-12 gap-4 border-b border-zinc-800 pb-2 font-bold'}>
                    <div className={'col-span-1'}>Id</div>
                    <div className={'col-span-7'}>Title</div>
                    <div className={'col-span-4'}>Created</div>
                </div>
                {categories.items && categories.items.map(function (item) {
                    let createdAt = format(parseISO(item.created_at), 'LLLL d, yyyy');
                    return (
                        <div key={item.id} className={'grid grid-cols-12 gap-4 mt-8'}>
                            <div className={'col-span-1'}>{item.id}.</div>
                            <div className={'col-span-7'}>{item.title}</div>
                            <div className={'col-span-4'}>{createdAt}</div>
                        </div>
                    );
                })}
            </div>

            <div className={'mt-24 text-zinc-700 px-8'}>
                {JSON.stringify({
                    'categories': categories
                }, null, 2)}
            </div>
        </>
    );
};
