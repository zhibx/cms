import {__, admin_url} from "@/helpers/functions";
import {useEffect, useState} from "react";
import axios from "axios";
import {Theme} from "@/types/themes";
import {Plugin} from "@/types/plugins";
import {Configs} from "@/pages/dev-tool/types/module";
import {router, usePage} from "@inertiajs/react";

export default function TopOptions({moduleSelected, moduleType}: { moduleSelected?: string, moduleType?: string }) {
    const {url, configs} = usePage<{ url: string, configs: Configs }>().props;
    const [themes, setThemes] = useState<Array<Theme>>();
    const [plugins, setPlugins] = useState<Array<Plugin>>();
    const [selectedOption, setSelectedOption] = useState<string>('');

    useEffect(() => {
        axios.get(admin_url(`dev-tools/modules`)).then((res) => {
            setThemes(res.data.themes);
            setPlugins(res.data.plugins);
        });
    }, [url]);

    const handleModuleChange = (e: any) => {
        let type = e.target.options[e.target.selectedIndex].getAttribute('data-type')?.toString() || '';
        let value = e.target.value;
        setSelectedOption('');
        localStorage.setItem('current_module', value);

        router.visit(admin_url(`dev-tools/${type}/${value}`), {replace: true});
    }

    const handleOptionChange = (e: any) => {
        e.preventDefault();

        setSelectedOption(e.target.value);

        localStorage.setItem('current_option', e.target.value);

        router.visit(admin_url(`dev-tools/${moduleType}/${moduleSelected}/${e.target.value}`),)
    }

    return <div className={'row'}>
        <div className={'col-md-4'}>
            <select
                className={'form-control'}
                onChange={handleModuleChange}
                value={moduleSelected}
            >
                <option value="">{__('--- Select Module ---')}</option>
                <optgroup label={__('Themes')}></optgroup>
                {themes && themes.map((theme: any) => (
                    <option
                        value={theme.name}
                        key={theme.name}
                        data-type={'themes'}
                    >
                        {theme.title} ({theme.name})
                    </option>
                ))}
                <optgroup label={__('Plugins')}></optgroup>
                {plugins && plugins.map((plugin: any) => (
                    <option value={plugin.name}
                            key={plugin.name}
                            data-type={'plugins'}
                            className={'dropdown-item'}
                    >{plugin.extra?.juzaweb?.name || plugin.name} ({plugin.name})</option>
                ))}
            </select>
        </div>

        <div className="col-md-4">
            <select className={'form-control'}
                    value={selectedOption}
                    onChange={handleOptionChange}>
                <option value="">{__('--- Options ---')}</option>
                {configs && configs.options.map((item) => (
                    <option
                        value={item.key}
                        key={item.key}
                    >
                        {__(item.label)}
                    </option>
                ))}
            </select>
        </div>
    </div>;
}
